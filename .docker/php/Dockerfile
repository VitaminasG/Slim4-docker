FROM php:8.2-fpm
ENV COMPOSER_ALLOW_SUPERUSER=1

ARG USER_ID
ARG GROUP_ID
USER $USER_ID:$GROUP_ID

RUN apt-get update && apt-get install -y libxml2-dev libzip-dev libssh-dev git
RUN docker-php-ext-install pdo pdo_mysql zip bcmath

RUN mkdir -m a=rwx /data
WORKDIR /data

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY .docker/php/conf/xdebug-configuration.ini /usr/local/etc/php/conf.d/xdebug-configuration.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ["composer.lock", "composer.json", "/data/"]

COPY .docker/php/docker-php.ini /usr/local/etc/php/php.ini

RUN composer install --no-dev --verbose --prefer-dist
