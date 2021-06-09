We are given a flag.png file, but if we try to open it as an image, it doesn't work. The file is damaged somehow. 

Instead, we can try opening it in a text editor - `vi flag.png`. The file contains mostly gibberish, but there are some strings that seem to indicate that this is in fact a png file - the EXIF & Pixel info, the IHDR string. So why can't it open?

If you open up a PNG file that you know works in a text editor and compare it to this flag.png file, you will notice the first two lines are missing from flag.png
```
<89>PNG^M
^Z
```

This data is the file signature that tells applications what kind of file they are working with. So we need to add it back to flag.png. Googling the file signature for PNG files reveals the characters (in hex) are `8950 4E47 0D0A 1A0A`.

Open the file in a hex editor to add the signature back. We will use `vi`.
1. `vi flag.png`
2. Transform the file to hex using the command `:%!xxd`
3. Replace the first 4 octets of zeros with the file signature `8950 4E47 0D0A 1A0A`
4. Transform the file back to text using the command `:%!xxd -r`
5. Save the file and quit vi `:wq`
6. Now open the file as an image to find the flag.