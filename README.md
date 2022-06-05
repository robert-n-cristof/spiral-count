# Spiral count

I generally write tools in PHP, but when performance matters, PHP just won't cut it. I ported this code to C
for this reason.

## The question / problem

I was exploring some transpositional cipher ideas, specifically perturbing a square grid of values into a spiral
pattern, and became curious to see if there was a pattern to the number of perturbations it would take for a
starting arrangement to return back to its initial state, as the width N increases.

i.e. for a grid of size 3, the first row remains the same, but the second row (4 5 6) wraps around the right hand side,
and the third row (7 8 9) wraps up the left side and inward to the center.  

```
0)        1)       2)       3)       4)       5)       6)

1 2 3     1 2 3    1 2 3    1 2 3    1 2 3    1 2 3    1 2 3
4 5 6 ==> 8 9 4 => 6 5 8 => 4 9 6 => 8 5 4 => 6 9 8 => 4 5 6
7 8 9     7 6 5    7 4 9    7 8 5    7 6 9    7 4 5    7 8 9
```

After 6 perturbations, the intial pattern is restored.

## The results

I didn't come up with a formula to explain the progression, but here are the numbers of the first several runs, 
preceded by their timings:
(spiral-count.php calls the c program for each iteration of N)

```sh
$ gcc spiral-count.c -lm -o spiral-count

$ php spiral-count.php
1 [0.000]: 1
2 [0.000]: 2
3 [0.000]: 6
4 [0.000]: 12
5 [0.000]: 10
6 [0.000]: 68
7 [0.000]: 840
8 [0.000]: 52
9 [0.000]: 560
10 [0.000]: 390
11 [0.011]: 29640
12 [0.055]: 158340
13 [0.027]: 67890
14 [0.004]: 8060
15 [13.998]: 29192700
16 [0.001]: 932
17 [96.975]: 152859168
18 [0.027]: 38220
19 [146.074]: 186568200
20 [0.007]: 7140
21 [37.130]: 38546970
22 [6.285]: 5861310
23 [381.567]: 314954640
24 [16.051]: 11701950
???  # I think this one took so long I skipped it..
26 [2.032]: 1290300
```