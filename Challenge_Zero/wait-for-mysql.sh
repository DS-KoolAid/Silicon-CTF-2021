#!/bin/sh
# wait-for-mysql.sh

set -e
  
host="$1"
shift
cmd="$@"
  

until mysql -h "$host" -u $MYSQL_USER -p$MYSQL_PASSWORD -e 'SHOW DATABASES'; do
  >&2 echo "MySQL is unavailable - sleeping"
  >&2 echo $MYSQL_PASSWORD
  sleep 1
done
  
>&2 echo "MySQL is up - executing command"
exec $cmd