#!/bin/bash

supervisord -c /etc/supervisord.conf
cat /etc/motd
until grep -q "kafka entered RUNNING state" /var/log/supervisord.log;
do
  echo -n -e 'Droid booting up.\r'
  sleep 0.5
  echo -n -e 'Droid booting up..\r'
  sleep 0.5
  echo -n -e 'Droid booting up...\r'
  sleep 0.5
  echo -n -e '                     \r'
done
echo "Booting sequence complete!"
cd /home/sili
su - sili
