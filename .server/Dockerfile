FROM php:7-apache
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y libpng-dev curl libcurl4-openssl-dev sendmail zlib1g-dev libjpeg-dev
RUN docker-php-ext-install pdo pdo_mysql mbstring zip
RUN echo "sendmail_path=/usr/sbin/sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
RUN echo "192.168.99.100 noreply.camagru.com $(hostname)" >> /etc/hosts
RUN /etc/init.d/sendmail start
RUN docker-php-ext-configure gd --with-png-dir=/usr/include --with-jpeg-dir=/usr/include
RUN docker-php-ext-install gd
COPY 000-default.conf /etc/apache2/sites-available
#docker-compose up -d --build
