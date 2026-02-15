FROM php:8.2-fpm-alpine

# Paquets + extensions PHP necessaries per Laravel + MySQL
RUN set -eux; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev oniguruma-dev libzip-dev mariadb-connector-c-dev; \
    apk add --no-cache icu libzip mariadb-connector-c nodejs npm git unzip; \
    docker-php-ext-configure intl; \
    docker-php-ext-install -j"$(nproc)" pdo_mysql bcmath intl mbstring zip; \
    docker-php-ext-enable opcache; \
    apk del .build-deps

# Afegim Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Usuari no root
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -D -u 1000 laravel
USER laravel
