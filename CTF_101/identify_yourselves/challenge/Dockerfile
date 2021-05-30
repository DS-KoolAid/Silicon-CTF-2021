FROM alpine:latest as build
RUN apk update
RUN apk upgrade
RUN apk add --update go gcc g++
WORKDIR /app
ENV GOBIN /app/bin
ADD challenge.go /app/src/challenge.go
RUN CGO_ENABLED=1 GOOS=linux go install -a src/challenge.go

FROM alpine:latest

RUN apk add --update curl openssl && \
addgroup -S sili && adduser sili -G sili -D

COPY --from=build /app/bin/challenge /app/bin/challenge
RUN chmod 750 /app && \
chmod 750 /app/bin && \
chown -R root: /app
COPY ./ca/chain.crt /app/chain.pem
COPY ./ca/server.key /app/server.key
COPY ./ca/challenge-ca.ini /home/sili/ca.cnf
COPY assets/conf/motd /etc/motd
COPY assets/scripts/entrypoint.sh /app/entrypoint.sh
RUN chown -R sili: /home/sili

ENV LISTEN_ADDR 0.0.0.0:443
ENV CERT_FILE /app/chain.pem
ENV KEY_FILE /app/server.key

CMD ["/app/entrypoint.sh"]
