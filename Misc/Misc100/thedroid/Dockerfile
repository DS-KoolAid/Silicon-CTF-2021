# Kafka and Zookeeper
FROM alpine:latest

RUN apk add --update openjdk8-jre supervisor bash gcompat

ENV ZOOKEEPER_VERSION 3.4.13
ENV ZOOKEEPER_HOME /opt/zookeeper-"$ZOOKEEPER_VERSION"

RUN wget -q http://archive.apache.org/dist/zookeeper/zookeeper-"$ZOOKEEPER_VERSION"/zookeeper-"$ZOOKEEPER_VERSION".tar.gz -O /tmp/zookeeper-"$ZOOKEEPER_VERSION".tgz
RUN ls -l /tmp/zookeeper-"$ZOOKEEPER_VERSION".tgz
RUN tar xfz /tmp/zookeeper-"$ZOOKEEPER_VERSION".tgz -C /opt && rm /tmp/zookeeper-"$ZOOKEEPER_VERSION".tgz
ADD assets/conf/zoo.cfg $ZOOKEEPER_HOME/conf

ENV SCALA_VERSION 2.13
ENV KAFKA_VERSION 2.6.0
ENV KAFKA_HOME /opt/kafka_"$SCALA_VERSION"-"$KAFKA_VERSION"
ENV KAFKA_DOWNLOAD_URL https://archive.apache.org/dist/kafka/"$KAFKA_VERSION"/kafka_"$SCALA_VERSION"-"$KAFKA_VERSION".tgz

RUN wget -q $KAFKA_DOWNLOAD_URL -O /tmp/kafka_"$SCALA_VERSION"-"$KAFKA_VERSION".tgz
RUN tar xfz /tmp/kafka_"$SCALA_VERSION"-"$KAFKA_VERSION".tgz -C /opt && rm /tmp/kafka_"$SCALA_VERSION"-"$KAFKA_VERSION".tgz

ADD assets/scripts/start-kafka.sh /usr/bin/start-kafka.sh
ADD assets/scripts/start-zookeeper.sh /usr/bin/start-zookeeper.sh
ADD assets/scripts/entrypoint.sh /root/entrypoint.sh
ADD assets/conf/motd /etc/motd
ADD assets/conf/flag_encoded.txt /etc/flag_encoded.txt
ADD assets/scripts/produce_flag.sh /etc/produce_flag.sh 
ADD assets/conf/server.properties $KAFKA_HOME/config/server.properties

# Supervisor config
ADD assets/supervisor/kafka.ini assets/supervisor/zookeeper.ini /etc/supervisor.d/

RUN apk --no-cache add ca-certificates wget && \
wget --quiet --output-document=/etc/apk/keys/sgerrand.rsa.pub https://alpine-pkgs.sgerrand.com/sgerrand.rsa.pub && \
wget https://github.com/sgerrand/alpine-pkg-kafkacat/releases/download/1.6.0-r0/kafkacat-1.6.0-r0.apk && \
apk add --no-cache kafkacat-1.6.0-r0.apk && \
addgroup -S sili && adduser sili -G sili -D && \
supervisord && \
$KAFKA_HOME/bin/kafka-topics.sh --bootstrap-server localhost:9092 --create --topic empire_intelligence -config retention.ms=2592000000 && \
/etc/produce_flag.sh && \
chown root: /root/entrypoint.sh && \
supervisorctl stop all && \
ps ax | grep kafka | grep java | awk '{print $1}' | xargs kill && \
sleep 5 && \
ps ax | grep zookeeper | grep java | awk '{print $1}' | xargs kill && \
sleep 5 && \
rm /var/log/supervisord.log /etc/flag_encoded.txt /etc/produce_flag.sh

ENTRYPOINT "/root/entrypoint.sh"
CMD ["/bin/bash"]
