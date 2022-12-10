#
FROM php:8.1.12-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite \
    && pecl install xdebug-3.2.0RC1 \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    git \
    sudo

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y \
  --no-install-recommends nodejs \
  && rm -rf /var/lib/apt/lists/*