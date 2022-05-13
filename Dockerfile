FROM php:8.0-apache

RUN apt-get update && apt-get install -y libpq-dev vim && docker-php-ext-install pdo pdo_pgsql pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html/
#RUN chmod 777 /var/www/html/files
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite
RUN a2enmod proxy
RUN a2enmod proxy_fcgi
RUN a2enmod proxy_balancer
RUN a2enmod proxy_http

ENV TZ=Asia/Tbilisi
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone 
RUN cd /var/www/html && php artisan migrate --force

