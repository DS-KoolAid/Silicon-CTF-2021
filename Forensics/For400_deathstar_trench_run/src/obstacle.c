#include <stdlib.h>

#include "obstacle.h"
#include "constants.h"

Obstacle* create_obstacle() {
        int gap, color, upper, lower;
        char shape;

        lower = WALL_THICKNESS;
        upper = ROWS - WALL_THICKNESS;
        gap = (rand() % (upper - lower + 1)) + lower;
        int obstacle_type = rand() % 2;
        if (obstacle_type == 0) {
            color = LASER_COLOR;
            shape = TIE_FIGHER;
        } 
        else {
            color = WALL_COLOR;
            shape = DEATHSTAR_WALL;
        }

        Obstacle* obstacle = malloc(sizeof(Obstacle));
        if (NULL != obstacle) {
                obstacle->x = COLUMNS - 1;
                obstacle->y_gap = gap;
                obstacle->color = color;
                obstacle->shape = shape;
                obstacle->is_deleted = 0;
                obstacle->next = NULL;
                obstacle->prev = NULL;
        }
        return obstacle;
}

Obstacle* add_obstacle(Obstacle* obstacle_list) {
    Obstacle* obstacle = create_obstacle();
    if (NULL != obstacle) {
        obstacle->next = obstacle_list;
        obstacle_list->prev = obstacle;
    }
    return obstacle;
}

void delete_obstacles(Obstacle* obstacle_list) {
    if (NULL != obstacle_list->next) {
        delete_obstacles(obstacle_list->next);
    }
    free(obstacle_list);
}