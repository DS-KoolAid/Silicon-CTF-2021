For this challenge we are given troopers.exe and asked to find the time when it was compiled. 

Running `file trooper.exe` reveals this is  a `troopers.exe: PE32 executable (console) Intel 80386, for MS Windows`.

Reading up about this file type known as a [Portable Executable](https://en.wikipedia.org/wiki/Portable_Executable) leads to a [handy diagram](https://en.wikipedia.org/wiki/File:Portable_Executable_32_bit_Structure_in_SVG_fixed.svg) on Wikipedia that outlines the structure of a PE file. Microsoft also has [documentation](https://docs.microsoft.com/en-us/windows/win32/debug/pe-format#coff-file-header-object-and-image) on this file format.  

Reviewing all this information, we can see in the COFF File Header section, there is a TimeDateStamp field that tells us when the file was created in epoch time.

To extract this value, there are many options. There exist tools like pev. You could write a script to parse out this section. We're going to do it by hand by viewing the file as hex.

1. To start, dump the hex of the file using hexdump `hexdump troopers.exe > hex.dump`
2. To find the start of the COFF File Header section, we look for the sequence `50 45 00 00` as that is the signature of the section. 
3. Then folloing the diagram linked above, we skip the next 4 bytes (remember each num in the hex file is 4 bits or half a byte) as those of the Machine & #NumberOfSections portions. The next 4 bytes is the timestamp field `1c 43 ea 0d`.
4. PE files are in little-endian format meaning the least signifcant byte comes first. What that means in simple terms is we need to reverse the order bytes to get the timestamp. Reversing gives `0d ea 43 1c`
5. We can convert the hex using [CyberChef's From Base (16) function](https://gchq.github.io/CyberChef/#recipe=From_Base(16)&input=MGRlYTQzMWM) and we get the value `233456412`
6. Following the challenge's description, the flag is `silicon{233456412}`