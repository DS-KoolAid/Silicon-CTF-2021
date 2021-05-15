Private key and ssh config reveal it's used for github

`ssh git@github.com -i id_rsa` returns the message `Hi tc-trooper17254! You've successfully authenticated, but GitHub does not provide shell access.`

Checking github, there is a user with this name - https://github.com/tc-trooper17254
One public repo - https://github.com/tc-trooper17254/personal-website

Some interesting tidbits in this repo
* robots.txt references /private_files/
* mention of flag potentially on memes.html in private_files/favorite_memes/rebel-flag.jpg

But no private_files folder to be seen, marked as ignored in .gitignore

Digging through git commits, the privates_files directory was removed here - https://github.com/tc-trooper17254/personal-website/commit/fed286b613a749ac4c33785dff9afe4eb03a264d
Still, looks like the memes folder was never added.

There's a README.md in the private_files directory hinting that this could be its own private repo - https://github.com/tc-trooper17254/personal-website/blob/eebefd6a789e39bdffc43ce1bfb4b4864f226bec/private_files/README.md
Since we have tc-trooper's private git key, we can see if the this repo exists and pull it down

We need to know the name of the repo. We can try private_files as the name as that is the header of the README file. GitHub will initialize README files with name of the repo.

Lastly, need to use one of these methods for specifying the key used for git: https://ma.ttias.be/specify-a-specific-ssh-private-key-for-git-pull-git-clone/

`GIT_SSH_COMMAND="ssh -i id_rsa" git clone git@github.com:tc-trooper17254/private_files.git`

Success! Opening favorite_memes/rebel-flag.jpg gives the flag `silicon{PR0t3ct_y0Ur_G1tHUb_k3y5}`