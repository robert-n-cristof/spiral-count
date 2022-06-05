#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/time.h>
#include <math.h>

int is_sorted(int* grid, int len)
{
    int i;

    // skip the first row, which is never perturbed
    for (i = (int)sqrt(len); i < len; i++) {
        if (grid[i] != i) {
            return 0;
        }
    }

    return 1;
}

int* rotate_spiral(int* grid, int width, int len)
{
    int i = 0;
    int j;
    int w = width;
    int x = 0;
    int y = 0;
    int* new_grid;

    // square of grid width 1 doesn't change. return the same grid
    if (width == 1) {
        return grid;
    }

    // make new grid
    new_grid = (int*) malloc(len * sizeof(int));

    // copy values from grid to new_grid in successive perimeters (layers of onion)
    while (w > 0) {
        if (w == 1) {
            new_grid[y * width + x] = grid[i];
        } else {
            // put chars into perimeter, right, down, left, then up
            for (j = 0; j < w - 1; j++) {
                new_grid[y * width + x] = grid[i];
                i++;
                x++;
            }
            for (j = 0; j < w - 1; j++) {
                new_grid[y * width + x] = grid[i];
                i++;
                y++;
            }
            for (j = 0; j < w - 1; j++) {
                new_grid[y * width + x] = grid[i];
                i++;
                x--;
            }
            for (j = 0; j < w - 1; j++) {
                new_grid[y * width + x] = grid[i];
                i++;
                y--;
            }
        }

        // after doing each perimeter, the available width goes down by 2
        w -= 2;

        // move into next perimeter
        x++;
        y++;
    }

    // deallocate the original grid
    free(grid);

    return new_grid;
}

int count_spirals(int width)
{
    // make an array to hold w * w (square) integers
    int len = width * width;
    int* grid = (int*) malloc(len * sizeof(int));
    int count = 1;
    int i;

    // initialize the array
    for (i = 0; i < len; i++) {
        grid[i] = i;
    }

    // count the number of spirals before the array is sorted again
    while(!is_sorted(grid = rotate_spiral(grid, width, len), len)) {
        count++;
    }

    free(grid);

    return count;
}

void main(int argc, char *argv[])
{
    int width;
    int num;
    struct timeval stop, start;
    float elapsed;

    if (argc > 1) {
        width = atoi(argv[1]);
    } else {
        width = 1;
    }

    gettimeofday(&start, NULL);
    num = count_spirals(width);
    gettimeofday(&stop, NULL);

    elapsed = ((stop.tv_sec - start.tv_sec) * 1000000 + stop.tv_usec - start.tv_usec) / 1000000.0;

    printf("%d [%.3f]: %d\n", width, elapsed, num);
}