TARGET = deathstar_trench_run
LIBS = -lm -lcurses
CC = gcc
CFLAGS = -Wall -s

.PHONY: default
.PRECIOUS: $(TARGET) $(OBJECTS)
default: $(TARGET)

MAINS=main.o
OBJECTS = $(filter-out $(MAINS), $(patsubst %.c, %.o, $(wildcard *.c)))
HEADERS = $(wildcard *.h)

deathstar_trench_run: main.o $(OBJECTS)
	$(CC) $(OBJECTS) main.o -Wall $(LIBS) -o deathstar_trench_run


%.o: %.c $(HEADERS)
	$(CC) $(CFLAGS) -c $< -o $@

clean:
	-rm -f *.o
	-rm -f $(TARGET)