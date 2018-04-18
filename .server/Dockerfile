FROM php:7-apache
COPY 000-default.conf /etc/apache2/sites-available
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite && service apache2 restart
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev ssmtp
RUN echo "" > /etc/ssmtp/ssmtp.conf
#docker-compose up -d --build
