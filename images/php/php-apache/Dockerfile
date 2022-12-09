#
FROM php:8.1.12-apache
RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite \
    && pecl install xdebug-3.2.0RC1 \
    && docker-php-ext-enable xdebug