
/* quest.c */

#include <ncurses.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <time.h>

#include "constants.h"
#include "art.h"
#include "obstacle.h"

int cleared_obstacle_count = 0;

void init_screen(void) {
    initscr();
    cbreak();
    noecho();
    start_color();
}

void init_colors(void) {
    init_pair(SPACE_COLOR, COLOR_BLACK, COLOR_BLACK);
    init_pair(SHIP_COLOR, COLOR_WHITE, COLOR_BLACK);
    init_pair(STAR_COLOR, COLOR_YELLOW, COLOR_BLACK);
    init_pair(XWING_COLOR, COLOR_RED, COLOR_BLACK);
    init_pair(LASER_COLOR, COLOR_GREEN, COLOR_BLACK);
    init_pair(WALL_COLOR, COLOR_BLACK, COLOR_WHITE);
}

void draw(int x, int y, char character, int color) {
    attron(COLOR_PAIR(color));
    mvaddch(y, x, character);
    attroff(COLOR_PAIR(color));
}

// int is_move_okay(int y, int x);
// void draw_map(Obstacle* obstacle_list);
void cursor_refresh(void) {
    // Keeps cursor off screen
    move(ROWS+TEXTBOX_HEIGHT, COLUMNS);
    refresh();

}

void draw_textbox(char* text) {
    attron(COLOR_PAIR(SHIP_COLOR));
    mvhline(ROWS+1, 0, '-', COLUMNS);
    mvhline(ROWS+TEXTBOX_HEIGHT+1, 0, '-', COLUMNS);
    mvvline(ROWS+2, 0, '|', TEXTBOX_HEIGHT-1);
    mvvline(ROWS+2, COLUMNS-1, '|', TEXTBOX_HEIGHT-1);
    attroff(COLOR_PAIR(SHIP_COLOR));

    int x = 2;
    int y = ROWS + TEXTBOX_HEIGHT/2 + 1;
    int message_length = strlen(text);
    for (int i=0; i < COLUMNS - x - 1; i++) {

        if (i < message_length) {
            draw(x+i, y, text[i], STAR_COLOR);
        } 
        else {
            draw(x+i, y, EMPTY, SPACE_COLOR);
        }
    }
    cursor_refresh();
}

char* load_flag() {

    if( access("flag.txt", F_OK ) == 0 ) {
        FILE *f = fopen("flag.txt", "rb");
        fseek(f, 0, SEEK_END);
        long fsize = ftell(f);
        fseek(f, 0, SEEK_SET);

        char* flag = malloc(fsize + 1);
        fread(flag, 1, fsize, f);
        fclose(f);

        return flag; 
    }
    else {
        return "No flag.txt file found.";
    }
}

int is_move_okay(int y, int x)
{
    int testch;

    testch = mvinch(y, x) &  A_CHARTEXT;
    return ((testch == EMPTY) || (testch == XWING));
}

void draw_map(Obstacle* obstacle_list)
{
    int x, y;

    // BORDER
    attron(COLOR_PAIR(WALL_COLOR));
    for (y = 0; y < WALL_THICKNESS; y++) {
        mvhline(y, 0, DEATHSTAR_WALL, COLUMNS);
        mvhline(ROWS-y, 0, DEATHSTAR_WALL, COLUMNS);
    }
    attroff(COLOR_PAIR(WALL_COLOR));

    if (NULL != obstacle_list) {
        Obstacle* iter;
        for (iter = obstacle_list; NULL != iter; iter = iter->next) {
            if (iter->is_deleted) {
                continue;
            }
            if (iter->x < 0) {
                iter->is_deleted = 1;
                cleared_obstacle_count++;
            }
            for (y = WALL_THICKNESS; y < (ROWS - WALL_THICKNESS) + 1; y++) {
                if (y != iter->y_gap) {
                    draw(iter->x, y, iter->shape, iter->color);
                }
            }
            iter->x--;
        }
    }
}

void intro(void) {
    int i, j;

    draw_textbox(INTRO_TEXT);

    for (i=0; i < INTRO_FRAMES; i++) {
        int x = 1;
        int y = 0;

        for (j=0; j < strlen(intro_art[i]); j++) {
            char c = intro_art[i][j];
            if (c == '\n') {
                y++;
                x = 0;
            } 
            else {
                switch (c) {
                    case ' ':
                        draw(x, y, c, SPACE_COLOR);
                        break;
                    case '*':
                    case 'X':
                        draw(x, y, c, XWING_COLOR);
                        break;
                    case '=':
                        draw(x, y, c, LASER_COLOR);
                        break;
                    default:
                        draw(x, y, c, SHIP_COLOR);
                        break;
                }
            }
            x++;
            cursor_refresh();
        }
        usleep(ANIMATION_SPEED_uS);
    }

    draw_textbox(GAME_START_TEXT);
    usleep(GAME_PAUSE_uS);
}

void game_over(int x, int y) {

    if (y < WALL_THICKNESS) {
        draw(x, y+1, EMPTY, SPACE_COLOR);
    } 

    if (y > ROWS - WALL_THICKNESS) {
        draw(x, y-1, EMPTY, SPACE_COLOR);
    }
    cursor_refresh();

    // *
    draw(x, y, EXPLOSION, XWING_COLOR);
    cursor_refresh();
    usleep(GAME_OVER_SPEED_uS);
    
    // ***
    draw(x-1, y, EXPLOSION, XWING_COLOR);
    draw(x+1, y, EXPLOSION, XWING_COLOR);
    cursor_refresh();
    usleep(GAME_OVER_SPEED_uS);

    // *
    //***
    // *
    draw(x, y-1, EXPLOSION, XWING_COLOR);
    draw(x, y+1, EXPLOSION, XWING_COLOR);
    cursor_refresh();
    usleep(GAME_OVER_SPEED_uS);
 
    //***
    //***
    //***
    draw(x-1, y-1, EXPLOSION, XWING_COLOR);
    draw(x+1, y-1, EXPLOSION, XWING_COLOR);
    draw(x-1, y+1, EXPLOSION, XWING_COLOR);
    draw(x+1, y+1, EXPLOSION, XWING_COLOR);
    cursor_refresh();
    usleep(GAME_OVER_SPEED_uS);

    draw_textbox(GAME_OVER_TEXT);
    usleep(GAME_PAUSE_uS);
}

void game_win(void) {
    int i, j;
    clear();
    draw_textbox(WIN_TEXT);

    for (i=0; i < OUTRO_FRAMES; i++) {
        int x = 1;
        int y = 0;

        for (j=0; j < strlen(outro_art[i]); j++) {
            char c = outro_art[i][j];
            if (c == '\n') {
                y++;
                x = 0;
            } 
            else {
                switch (c) {
                    case ' ':
                        draw(x, y, c, SPACE_COLOR);
                        break;
                    case '*':
                        draw(x, y, c, STAR_COLOR);
                        break;
                    case 'X':
                        draw(x, y, c, XWING_COLOR);
                        break;
                    case '=':
                        draw(x, y, c, LASER_COLOR);
                        break;
                    default:
                        draw(x, y, c, SHIP_COLOR);
                        break;
                }
            }
            x++;
            cursor_refresh();
        }
        usleep(ANIMATION_SPEED_uS);
    }
    
    int x = 4;
    char* flag = load_flag();

    for (int i = 0; i < strlen(flag); i++) {
        draw(x + i, ROWS/2, flag[i], LASER_COLOR);
        refresh();
        usleep(250000);
    }
    usleep(GAME_PAUSE_uS);
}

void draw_vent(void) {
    // / - \
    // | 0 |
    // \ _ /
    draw(COLUMNS - 6, WALL_THICKNESS + 1, '/', SHIP_COLOR);
    draw(COLUMNS - 6, WALL_THICKNESS + 2, '|', SHIP_COLOR);
    draw(COLUMNS - 6, WALL_THICKNESS + 3, '\\', SHIP_COLOR);

    draw(COLUMNS - 5, WALL_THICKNESS + 1, ' ', SHIP_COLOR);
    draw(COLUMNS - 5, WALL_THICKNESS + 2, ' ', SHIP_COLOR);
    draw(COLUMNS - 5, WALL_THICKNESS + 3, ' ', SHIP_COLOR);
    
    draw(COLUMNS - 4, WALL_THICKNESS + 1, '-', SHIP_COLOR);
    draw(COLUMNS - 4, WALL_THICKNESS + 2, '0', SHIP_COLOR);
    draw(COLUMNS - 4, WALL_THICKNESS + 3, '_', SHIP_COLOR);

    draw(COLUMNS - 3, WALL_THICKNESS + 1, ' ', SHIP_COLOR);
    draw(COLUMNS - 3, WALL_THICKNESS + 2, ' ', SHIP_COLOR);
    draw(COLUMNS - 3, WALL_THICKNESS + 3, ' ', SHIP_COLOR);

    draw(COLUMNS - 2, WALL_THICKNESS + 1, '\\', SHIP_COLOR);
    draw(COLUMNS - 2, WALL_THICKNESS + 2, '|', SHIP_COLOR);
    draw(COLUMNS - 2, WALL_THICKNESS + 3, '/', SHIP_COLOR);
}

void fire(void) {
    int xwing_x_pos = 3;
    int x;
    int y = ROWS/2;

    for (x = 4; x < COLUMNS - 3; x++) {
        clear();
        draw_map(NULL);
        draw_vent();
        draw(xwing_x_pos, ROWS/2, XWING, XWING_COLOR);
        draw_textbox(VENT_TEXT);

        if (x > 3) {
            draw(x-1, y, '-', XWING_COLOR);
        }
        draw(x, y, '*', XWING_COLOR);
        move(ROWS + 2 + TEXTBOX_HEIGHT/2, 2);
        refresh();
        usleep(FIRE_SPEED_uS);
    }

}

void c(char *buf, int size, ...)
{
	va_list args;
	va_start (args, buf);     /* Initialize the argument args. */

	char arg = va_arg(args, int);
    int i = 0;
	while( arg ) {
        if (i >= size) {
            break;
        }
        buf[i] = arg;
		arg = va_arg(args, int);
        i++;
	}

	va_end (args);                  /* Clean up. */
}

void end_game(void) {
    int xwing_x_pos = 3;
    int x = 2;
    int y = ROWS + 2 + TEXTBOX_HEIGHT/2;

    clear();
    draw_map(NULL);
    draw(xwing_x_pos, ROWS/2, XWING, XWING_COLOR);

    draw_textbox(VENT_TEXT);
    draw_vent();

    move(ROWS + 2 + TEXTBOX_HEIGHT/2, 2);
    refresh();

    bool wait = true;
    char coordinates[12];
    int i = 0;
    timeout(-1);

    while (wait) {
        char input = getch();

        if (input == '\n') {
            fire();
            wait = false;
        }
        else if (input == '\b' || input == 127 || input == 224) {
            if (i > 0) {
                i--;
                x--;
                draw(x, y, EMPTY, SPACE_COLOR);
            }
        }
        else {
            if (i < COORDINATES_LENGTH) {
                draw(x, y, input, LASER_COLOR);
                coordinates[i] = input;
                i++;
                x++;
            }
        }
    }
    coordinates[i] = '\0';

    bool is_win = true;
    char vent_coordinates[COORDINATES_LENGTH] = {0};
	c(vent_coordinates, COORDINATES_LENGTH, '4','2','.','7','9',',','6','6','.','9','8', '\0');
    for (i = 0; i < COORDINATES_LENGTH; i++) {
        if (coordinates[i] != vent_coordinates[i]) {
            is_win = false;
            break;
        }
    }
    if (is_win) {
        draw_textbox(HIT_TEXT);
        usleep(GAME_PAUSE_uS);
        game_win();
    }
    else {
        draw_textbox(MISS_TEXT);
        usleep(GAME_PAUSE_uS);
        game_over(xwing_x_pos, ROWS/2);
    }
}

void game_loop(void) {
    int x = 3;
    int y = ROWS / 2;
    bool play = true;
    bool is_end_game = false;
    int tick = 0;
    int total_obstacle_count = 0;
    Obstacle* obstacle_list = NULL;
    timeout(GAME_SPEED_MS);

    while (play) {
        
        clear();
        draw(x, y, XWING, XWING_COLOR);
        draw_map(obstacle_list);
        draw_textbox(CONTROLS_TEXT);

        if (tick % OBSTACLE_RATE == 0) {
            if (total_obstacle_count < MAX_OBSTACLES) {
                if (total_obstacle_count == 0) {
                    obstacle_list = create_obstacle();
                }
                else {
                    obstacle_list = add_obstacle(obstacle_list);
                }
                total_obstacle_count++;
            }
        }

        cursor_refresh();

        char input = getch();

        switch (input) {
            case 'w':
            case 'W':
                if ((y > 0)) {
                    y = y - 1;
                }
                break;
            case 's':
            case 'S':
                if ((y < ROWS - 1)) {
                    y = y + 1;
                }
                break;
            case 'q':
            case 'Q':
                play = false;
                break;
        }

        tick++;

        // Game over
        if (!is_move_okay(y, x)) {
            game_over(x, y);
            play = false;
        }

        // End game
        if (cleared_obstacle_count == MAX_OBSTACLES) {
            play = false;
            is_end_game = true;
        }

    }

    if (NULL == obstacle_list) {
        delete_obstacles(obstacle_list);
    }

    if (is_end_game) {
        end_game();
    }

    endwin();
    exit(0);
}

int main(void)
{
    srand(time(0));
    init_screen();
    init_colors();
    intro();
    game_loop();
}



