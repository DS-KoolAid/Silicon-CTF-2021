FROM alpine:latest

ADD entrypoint.sh /root/entrypoint.sh
ADD motd /etc/motd
RUN apk add --update bash
RUN addgroup -S sili && adduser sili -G sili -D && chown root: /root/entrypoint.sh && chmod 777 /root/entrypoint.sh

ENTRYPOINT "/root/entrypoint.sh"
CMD ["/bin/bash"]



