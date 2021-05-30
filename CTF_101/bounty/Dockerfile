FROM alpine:3.9

#
# Install all required dependencies.
#

RUN apk --update upgrade && \
    apk add --update bind && \
    apk add --update bind-tools && \
    rm -rf /var/cache/apk/*

#
# Add named init script.
#

ADD assets/scripts/entrypoint.sh /root/entrypoint.sh
RUN chmod 750 /root/entrypoint.sh
RUN mkdir /var/log/named && \
addgroup -S sili && adduser sili -G sili -D


#
# Define container settings.
#

#VOLUME ["/etc/bind", "/var/log/named"]

ADD assets/conf/motd /etc/motd
ADD bindconfig/ /etc/bind

#
# Start named.
#

ENTRYPOINT ["/root/entrypoint.sh"]
CMD ["/bin/bash"]
