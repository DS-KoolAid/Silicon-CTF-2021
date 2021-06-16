#include <stdio.h>
#include <unistd.h>

int main(int argc, char **argv)
{
    setreuid(1001, 1001);
    if (argc == 1) {
        printf("Usage: ./yodasay <message>\n");
    }
    else {
        printf("%s, I say\n", argv[1]);
        system("cat /home/officer/art.txt");
    }    

    return (0);
}