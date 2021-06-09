This is a reverse engineering challenge! 

You load the terminal challenge and you are met with an ASCII game where you have to dodge the obstacles (20 in total) until you make it a screen prompting you to enter the coordinates for the vent. The problem is that the vent coordinates aren't provided, and you can try to put force, but the answer ends up being 12 characters long.

So back to reversing the binary. You're given a copy that you can work with locally. 

1. Dissamble the binary using objdump `objdump -D deathstar_trench_run > deathstar_trench_run.disas`. See the included example file
2. Reading through the dissambled binary, we find the main function (in the example, line #3402). This shows some other interesting functions like game_loop.
3. Reading through the game_loop function (line #3278), we spot another interesting function called end_game.
4. Reading through the end_game function (line #3143), we see it calls the draw_vent and game_win functions so this is likely the right function.
5. At this point, you'll likely need to step through the code using a tool like GDB to understand what each instruction is doing in this function, but you can see a bunch of integers being pushed onto the stack around line #3227. If you convert those integers to ASCII and reverse the the order (cause stacks are last in, first out), you get the string 42.79,66.98 

Once you have the correct coords (42.79,66.98), you need to play the game on the server and enter them to win the game and get the flag.

**Note:** it turns out the program `ltrace` trivializes this problem as it will reveal the coordinates in the dump. That was a good thing to learn. I'll be sure to fix that for next year. :)