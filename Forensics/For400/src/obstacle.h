#ifndef OBSTACLE_H
#define OBSTACLE_H

typedef struct s_obstacle {
    int x;
    int y_gap;
    int color;
    char shape;
    int is_deleted;
    struct s_obstacle* next;
    struct s_obstacle* prev;
} Obstacle;

Obstacle* create_obstacle(); 
Obstacle* add_obstacle(Obstacle* obstacle_list);
void delete_obstacles(Obstacle* obstacle_list);

#endif