#ifndef CONSTANTS_H
#define CONSTANTS_H

#define ROWS 13
#define COLUMNS 66

#define WALL_THICKNESS 4
#define TEXTBOX_HEIGHT 4

#define SPACE_COLOR 1
#define SHIP_COLOR 2
#define STAR_COLOR 3
#define LASER_COLOR 4
#define WALL_COLOR 5
#define XWING_COLOR 6

#define EMPTY ' '
#define DEATHSTAR_WALL '#'
#define XWING 'X'
#define TIE_FIGHER 'H'
#define EXPLOSION '*'

#define ANIMATION_SPEED_uS 250000
#define GAME_OVER_SPEED_uS 500000
#define GAME_SPEED_MS 100
#define GAME_PAUSE_uS 2000000
#define FIRE_SPEED_uS 100000

#define MAX_OBSTACLES 20
#define OBSTACLE_RATE 15

#define CONTROLS_TEXT "W - move up; S - move down; Dodge the obstacles!"
#define GAME_OVER_TEXT "GAME OVER!"
#define INTRO_TEXT "Welcome to DEATHSTAR TRENCH RUN!"
#define GAME_START_TEXT "You're all clear! Let's blow this thing and go home!"
#define VENT_TEXT "There's the vent! Type & ENTER the coords! Ex: 25.47,47.23"
#define MISS_TEXT "You missed!"
#define HIT_TEXT "You hit!"
#define WIN_TEXT "You've done it! The Deathstar is no more!" 

#define COORDINATES_LENGTH 12

#endif