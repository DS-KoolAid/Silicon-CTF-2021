#!/bin/bash
while read l;
do
  echo "$l" | /usr/bin/kafkacat -P -b localhost:9092 -t empire_intelligence 
done < /etc/flag_encoded.txt
