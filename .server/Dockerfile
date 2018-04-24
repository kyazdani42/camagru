FROM php:7-apache
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev
RUN docker-php-ext-install pdo pdo_mysql
COPY 000-default.conf /etc/apache2/sites-available
RUN a2enmod rewrite && service apache2 restart
#docker-compose up -d --build
