FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache curl git unzip $PHPIZE_DEPS openssl-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer install --optimize-autoloader --no-dev

COPY . .
