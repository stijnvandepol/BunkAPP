FROM php:8.0-apache

COPY ./src /var/www/html/

RUN docker-php-ext-install mysqli