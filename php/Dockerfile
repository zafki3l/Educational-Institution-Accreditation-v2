FROM php:8.2-fpm-alpine

RUN apk add --no-cache curl git unzip

RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
