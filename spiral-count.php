#!/usr/bin/env php
<?php

// make all spirals
// require_once('utils.php');
// gcc spiral-count.c -lm -o spiral-count

$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';

for ($i = 1; $i <= 100; $i++) {
    echo `./spiral-count $i`;
    // $time = microtime(true);
    // $square = $i * $i;
    // $arr = range(1, $square);
    // $orig = $arr;

    // $j = 1;
    // while (($arr = spiral_rotate($arr, $i)) !== $orig) {
    //     $j++;
    // }

    // // $fact = fact($i);
    // // $ratio = $fact / $j;
    
    // $delta = round(microtime(true) - $time, 4);
    // echo "$i: $j    [$square; $delta]" . PHP_EOL;
}

function fact($n): int
{
    if ($n <= 2) {
        return $n;
    }

    return $n * fact($n - 1);
}

function spiral_rotate(array $arr, int $width = 0): array
{
    $len = count($arr);
    // if ($len == 0) {
    //     return [];
    // }

    // if ($len == 1) {
    //     return [1];
    // }

    // if ($width < 1) {
    //     $width = (int)(ceil(sqrt($len)));
    // }

    // $square = $width * $width;
    // if ($len != $square) {
    //     return [];
    // }

    // build a new grid by tracing a spiral around the output
    $new_arr = array_fill(0, $len, '');
    $w = $width;
    $x = 0;
    $y = 0;
    $i = 0;
    while ($w > 0) {
        if ($w == 1) {
            $new_arr[$y * $width + $x] = $arr[$i];
        } else {
            // put chars into perimeter, right, down, left, then up
            for ($j = 0; $j < $w - 1; $j++) {
                $new_arr[$y * $width + $x] = $arr[$i];
                $i++;
                $x++;
            }
            for ($j = 0; $j < $w - 1; $j++) {
                $new_arr[$y * $width + $x] = $arr[$i];
                $i++;
                $y++;
            }
            for ($j = 0; $j < $w - 1; $j++) {
                $new_arr[$y * $width + $x] = $arr[$i];
                $i++;
                $x--;
            }
            for ($j = 0; $j < $w - 1; $j++) {
                $new_arr[$y * $width + $x] = $arr[$i];
                $i++;
                $y--;
            }
        }

        // after doing each perimeter, the available width goes down by 2
        $w -= 2;

        // move into next perimeter
        $x++;
        $y++;
    }


    return $new_arr;
}

function isSortedAscending(array $arr)
{
    $count = count($arr);
    if ($count < 2) {
        return true;
    }

    for ($i = 1; $i < $count; $i++) {
        if ($arr[$i - 1] > $arr[$i]) {
            return false;
        }
    }

    return true;
}
