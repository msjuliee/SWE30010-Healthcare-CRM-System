FROM php:7.4-apache

RUN apt update -y && apt upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY assign2_LD/ /var/www/html/
