FROM php:7-apache
ADD src /var/www/html
ADD wait-for-mysql.sh /var/www/
RUN chmod +x /var/www/wait-for-mysql.sh
RUN chown www-data: /var/www/wait-for-mysql.sh
RUN chmod -R 777 /var/www/html/*
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get install -y default-mysql-client
