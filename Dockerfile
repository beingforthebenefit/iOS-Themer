FROM php:7.3-apache

#Install git
RUN apt-get update && apt-get install -y git imagemagick
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www

EXPOSE 80