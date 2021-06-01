FROM alpine:latest

RUN apk add build-base bash

RUN adduser --disabled-password --gecos '' trooper
RUN adduser --disabled-password --gecos '' officer

WORKDIR /tmp
ADD src/ ./
RUN gcc yodasay.c -o yodasay && mv yodasay /home/officer/
RUN chmod 444 /tmp/yodasay.c


WORKDIR /home/officer
ADD ./artifact.txt ./artifact.txt
ADD ./art.txt ./art.txt

RUN chown officer: artifact.txt
RUN chown officer: art.txt 
RUN chown officer: yodasay
RUN chmod 400 artifact.txt
RUN chmod 755 art.txt
RUN chmod 4755 yodasay

# Run as an unprivileged user
USER trooper
WORKDIR /home/trooper/

CMD ["/bin/bash"]