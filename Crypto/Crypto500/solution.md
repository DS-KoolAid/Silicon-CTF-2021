# Crypto500 - Putting the Pieces Together

## Challenge Text: 

Your hacker team was deep inside the empire network and found a highly important encrypted file and a screenshot of the private key used to decrypt the file. How lucky! Unfortunately,  when exfiltrating the private key, your team was discovered and had their access cut off. We only got a portion of the key. 

Is there anything we can do to decrypt the file?

## Hints: 

1. This key is in the OpenSSH format. 
    [Link](https://coolaj86.com/articles/the-openssh-private-key-format/)

2. [Check this out](https://blog.cryptohack.org/twitter-secrets)

3. 	If you have p and q... you have everything you need

## How To Solve: 

The idea behind this challenge was to figure out what was missing from the private ssh key snippets and then if possible, recreate the private key. 

Using OCR or just typing out the text from the image, we are left with: 

```
-----BEGIN OPENSSH PRIVATE KEY-----
b3BlbnNzaC1rZXktdjEAAAAABG5vbmUAAAAEbm9uZQAAAAAAAAABAAABlwAAAAdzc2gtcn
NhAAAAAwEAAQAAAYEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFmBWCwR4VgsEeAAAAB3NzaC1yc2
EAAAGBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMBAAEAAAGAS7YT/eG8rFlG0A3ecucUeOqj5Z
WfLSmL07zZz6DKdm/wgWbDs3upSxxJ6p8UX4U5EH7aHGI2EKORFt3euPxvQmtdon5EymVS
UW8BbD8bcyngCWOIwYrspvPT2vdfhkdglH3wueg2pSH9jV5E+c5PHHKh/fq1gI+vaMTsST
ThDzRjW+f173bu9BS0+QH9h6/o8DT92FTuAtdnOSubV/RIxKLorIgJXx/Z+3lDwc8ukodv
wEm5vS795yWyXi/gd2EoGgMSxjBTKdt37uZIqYVLY7J1XT6+YBprLZ7UC4/cy5mn3tT56J
0goBI2h/9BWdi2tM9aKiVT4c+e/JH22pnU4mrPkTLEwUdRlmyIKZQQ74361gwKYkG1TzDC
JgGhdmLcQAmb7kzuL8BYGReLkk9F3Vi5JnbOi6rzsTxk7tsGpuhevw8bq4FZGJxHEnbEfh
ECAXLx5XPHWRLMtpM6KvPSizokv5qshYChf4gGVszW854xO6etDacSCuugLWjxMHphAAAA
wQCJ2z9Pb1JMGVNwKsTRWAf46LGMSMXg3iSKfJJ9EaQGdkGKQj+dvkgJRg0vNDTe+6FzCL
AVZSdHOjwxKutBtpN4YfiryaUYQ93pbReASP/7JDtUmxthY0rTqYLjx+jgd199/RABymHb
MJtB40QQj2KKqJQHcIOJERHcn3S+hgYKLRElt/sndcSQThruHISTErwVHVl8vJvUfPpBXa
IT/zg845yDc5FVMJmY08kFSEIX2pc2p2ZLsxQxgq3CZUmmXiYAAADBAOI75l6d0XqvkHqt
r20D7Vljfxt5ppXeq88Ox9GM6DctnrtMUehmPuqAE0Av+w+XRW+97/EnU6I/T2WEAE0FZA
kWxpAgnq6VQCHuRtoQOUPX+uG0HdPLQHi/yOe0iiieD7m1LBE6RJ4SYTe8z67Wnvz7hzZl
0OB/YwGzEGqXefvxzpu2abVF0iTGXUnt6pil/9rCfCPfijKHDKipM8NX4tDgTlVUQVT2mG
A3z7Say1EBTBwPx7larjAkUEAsOhqhTQAAAMEAwwmJC+FnqlRyfIG1MfwMncid2hfrYSFY
ki6AQK8My6u+ut3UZUwTdf9tjdvdMr3C4yeaJpP+Eoynxe2y/phA7cK6EB4MChPkSfObA0
vh89DQCgU5aYAbm7H6fuOoJlTESBowFhFH8RNHRkWVtGG982JVKVONqj+AnYcEUFg6WdOf
wiE2zjPcNsOhAw+/QlL0whzriJZeDW+PbSauGZ6MvuKgeE3f2uCUDTsDb/JjmEW61oHobm
Ujy4SzjvOCqa1rAAAAHXJvb3RAbG9jYWxob3N0LmxvY2FsAQIDBAU=
-----END OPENSSH PRIVATE KEY-----
```

If we remove the top and bottom of this, we are left with one big base64 encoded blob. 

To get this in its binary form, we can remove those two lines and then save that in a file. 

We can then run: 

`cat file | base64 -d > binary_key_file` 

Next, lets open up that binary file in a hex editor: 

![ ](solution_images/bin.png)

We can see here we have a lot of NULL data where those "AAA.."s are. 

If we parse through the file, we can start to identify some key componets of the key: 

![ ](solution_images/highlight.png)

Really the only thing missing from the key is the modulus. And in the RSA algorithm, the modules is equal to `p * q`. Which we have - p is hightlighted in yellow, q is highlighted in blue. 

We can generate the modulus like this in python: 

```python
>>> p = int("E23BE65E9DD17AAF907AADAF6D03ED59637F1B79A695DEABCF0EC7D18CE8372D9EBB4C51E8663EEA8013402FFB0F97456FBDEFF12753A23F4F6584004D05640916C690209EAE954021EE46DA103943D7FAE1B41DD3CB4078BFC8E7B48A289E0FB9B52C113A449E126137BCCFAED69EFCFB873665D0E07F6301B3106A9779FBF1CE9BB669B545D224C65D49EDEA98A5FFDAC27C23DF8A32870CA8A933C357E2D0E04E55544154F6986037CFB49ACB51014C1C0FC7B95AAE302450402C3A1AA14D", 16)
>>> q = int("C309890BE167AA54727C81B531FC0C9DC89DDA17EB612158922E8040AF0CCBABBEBADDD4654C1375FF6D8DDBDD32BDC2E3279A2693FE128CA7C5EDB2FE9840EDC2BA101E0C0A13E449F39B034BE1F3D0D00A053969801B9BB1FA7EE3A82654C4481A30161147F11347464595B461BDF3625529538DAA3F809D870450583A59D39FC22136CE33DC36C3A1030FBF4252F4C21CEB88965E0D6F8F6D26AE199E8CBEE2A0784DDFDAE0940D3B036FF2639845BAD681E86E6523CB84B38EF382A9AD6B", 16)
>>> hex(p * q)
'0xac5c0db1b997e7702e777ca92df8741a07956ee2e902beceec9ec3ad495442654b87201822fede6004bd70298989c73c211467ae4c36a9545a4c9bfd7ff98743924d2b2e7beedfb55cbe65e708c87ead8a6ef0b0308cfc23b788549d74e6216d0ebfa0e22a30fe0c9da4679a0e5418b5d9ed02c7dd869bde7f2ac3d577db53e3482cc6ed092f5481a6a815d4bbc15f954a378b29bfac8cc3ba00aa59e1e7767e3c84511b55c0b2133cd192e5bd5831b5ad9dd6c1a2ab7a06817d5956513c72d2af6fe0aeed25d04f78e70533e34ffb77e1e31e82d735c9f1995a0986315c3b49164107b04272a0528231ae30ebcc0b1f47beefbb07e278529b41eede0e5589e5bcd0969725d4b0d9d8887b3a3354570eefbc83198b95e94d6018c238cac35f8dfea928384e2f835c38c747fa441f12f54346c1f816bf54fd8df0c10fe0c73d77cbb2bacdbf2be4de6a27b187742fe46e9afef338445d6403e4b25237ff971ed80bec4b15bc06bb3dedfa54379c236d136c0e12b54a0a4d49a5336954ddf7742f'
```

You can then take this modulus value and plug it back into the private key. 

Once you have the private key, you can use `ssh-vault` to decrypt the file: 

```
/tmp ❯ ssh-vault -k private_key view .solution/super_important_deathstar_file.txt > answer.txt

/tmp ❯ cat answer.txt
           .          .
 .          .                  .          .              .
       +.           _____  .        .        + .                    .
   .        .   ,-~"     "~-.                                +
              ,^ ___         ^. +                  .    .       .
             / .^   ^.         \         .      _ .
            Y  l  o  !          Y  .         __CL\H--.
    .       l_ `.___.'        _,[           L__/_\H' \\--_-          +
            |^~"-----------""~ ^|       +    __L_(=): ]-_ _-- -
  +       . !                   !     .     T__\ /H. //---- -       .
         .   \                 /               ~^-H--'
              ^.             .^            .      "       +.
                "-.._____.,-" .                    .
         +           .                .   +                       .
  +          .             +                                  .
         .             .      .       
                                                        .

silicon{EvenPartOfAPrivateKeyRevealsData}
```
