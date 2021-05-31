# Kafka and Zookeeper
FROM alpine:latest

RUN apk add build-base bash git

RUN adduser --disabled-password --gecos '' ctf

# Run as an unprivileged user
USER ctf

RUN mkdir /home/ctf/repo
WORKDIR /home/ctf/repo
RUN git config --global user.email "ctf@local"
RUN git config --global user.name "ctf"
RUN git init
ADD ./flag.txt ./flag.txt
RUN git add flag.txt
RUN git commit -m "Initial commit"
RUN git rm flag.txt
RUN git commit -m "Remove flag.txt"

WORKDIR /home/ctf/

CMD ["/bin/bash"]