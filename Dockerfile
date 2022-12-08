FROM php:8.1-fpm

RUN apt-get upgrade -y
RUN apt-get update

RUN apt-get install -y \
        libicu-dev libpq-dev
RUN docker-php-ext-install \
        pgsql pdo_pgsql \
    && docker-php-ext-enable \
        pgsql pdo_pgsql