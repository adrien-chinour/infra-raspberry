FROM php:7.4-fpm
MAINTAINER Adrien Chinour <git@chinour.fr>

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    curl nano git apt-transport-https build-essential apt-utils openssl \
    libpng-dev locales libicu-dev zip unzip libzip-dev libpq-dev; \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl; \
	docker-php-ext-install zip intl gd pgsql pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer global require "symfony/flex" --prefer-dist --no-progress --no-suggest --classmap-authoritative; \
    composer clear-cache

ENV PATH="${PATH}:/root/.composer/vendor/bin"

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

RUN echo 'alias sf="php bin/console"' >> ~/.bashrc

WORKDIR /app
EXPOSE 9000
CMD ["php-fpm"]