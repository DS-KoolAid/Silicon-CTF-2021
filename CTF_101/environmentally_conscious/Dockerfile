FROM alpine:latest

RUN apk add build-base bash

# Restrict user
RUN cp /bin/bash /bin/rbash
RUN adduser --disabled-password --gecos '' -s /bin/rbash trooper
RUN mkdir /home/trooper/programs
ADD ./bash_profile /home/trooper/.bash_profile

# Provide the following commands
RUN ln -s /bin/ls /home/trooper/programs/
RUN ln -s /bin/date /home/trooper/programs/
RUN ln -s /bin/which /home/trooper/programs/
RUN ln -s /bin/cat /home/trooper/programs/
RUN ln -s /bin/hostname /home/trooper/programs/
RUN ln -s /bin/echo /home/trooper/programs/
RUN ln -s /usr/bin/whoami /home/trooper/programs/
RUN ln -s /usr/bin/id /home/trooper/programs/
RUN ln -s /usr/bin/env /home/trooper/programs/

# Run as an unprivileged user
USER trooper
WORKDIR /home/trooper/

ENV FLAG silicon{3nv1R0nm3nt_v4R5_aR3_k00L}

CMD ["/bin/rbash"]