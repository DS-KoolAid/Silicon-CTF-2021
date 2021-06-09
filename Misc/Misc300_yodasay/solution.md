When we land in the terminal, we find yourself in the /home/trooper directory.
`whoami` reveals we are the user trooper.

Checking for other users on the box, we can look in the /home directory to find there is a directory for the officer user - /home/officer.

In /home/officer, if we check permissions with `ls -la`, we can see artifact.txt is readable only by officer, so this should indicate we need to find some way to escalate privleges.

We can see the SUID bit is set on yodasay and it's owned by officer, so that could be a path for escalation.

Running `./yodasay` shows that it takes a message argument. Providing that shows that all this program does is repeat what you provide and adds Yoda ASCII art. It's the same art that can be found in art.txt

Hunting around more on the system, we find the sourcecode for yodasay in /tmp/yodasay.c. On line #11, we see `system("cat art.txt");`. 
When a program is executed without providing the full path, Linux checks the PATH variable from left to right, trying to find which program to run. So in this case, the PATH variable is set to `/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin` and cat is found in the last location `/bin/cat`. 

We can take advantage of the fact that the program does not specify the full path of cat, by making our own cat program and modify the PATH so it gets seen first.

In /home/trooper/, we make our own cat that drops into a shell  `echo '/bin/sh' > cat'. Make it executable `chmod +x cat`

Then, we go to /home/officer and modify PATH to point to our cat `export PATH=/home/trooper`.

Then run yodasay `./yodasay` to get a shell as officer.

We need to fix PATH in order to run other commands like the correct cat :) `export PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin`

Then reading artifact.txt gives us the flag - `cat artifact.txt`
silicon{M1nd_tH053_rE14t1v3_p4th5_i_say}

Some solvers noticed in the yodasay.c source that art.txt also did not use a full path, so an alternative solution is to use a symbolic link to have artifact.txt point to an art.txt file. That wasn't intentional but cool to see folks figure out!