FROM php:7-apache

ADD crypto400_files.zip /var/www/html/
ADD crypto400_second.zip /var/www/html/

ADD ok_this_one_should_work.zip /var/www/html/

RUN chmod +r /var/www/html/crypto400_files.zip
RUN chmod +r /var/www/html/crypto400_second.zip
RUN chmod +r /var/www/html/ok_this_one_should_work.zip