FROM php:7-apache
COPY 000-default.conf /etc/apache2/sites-enabled
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev
#docker-compose up -d --build
