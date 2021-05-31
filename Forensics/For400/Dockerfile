# Kafka and Zookeeper
FROM alpine:latest

RUN apk add build-base ncurses-dev bash

RUN adduser --disabled-password --gecos '' ctf

WORKDIR /tmp
ADD src/ ./
RUN make && mv deathstar_trench_run /home/ctf/ && rm -rf /tmp/*

# Run as an unprivileged user
WORKDIR /home/ctf/
ADD ./flag.txt ./flag.txt
USER ctf
CMD ["./deathstar_trench_run"]