1. Using stegosuite and open Stuffed.jpg and use the option to extract you get "WhatsThis.xxd" 
2. The file is a hex dump of a file that has been compressed multiple times 
3. simply run file on it to determine the next type of compression
4. Then uncompress each file using the right tool until you get to the .txt
5. The txt file contains a simple base64 string which is the flag
