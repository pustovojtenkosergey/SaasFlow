FROM php:8.0-fpm

# Install extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    apt-utils \
    libxml2-dev \
    libtool \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    libmcrypt-dev \
    zip \
    libtool \
    supervisor \
    bash \
    nano \
    ghostscript \
    mc \
    htop \
    wget

RUN apt-get update \
    && docker-php-ext-install bcmath \
        gettext \
        opcache \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install pdo_mysql \
        intl \
        zip \
        pcntl \
        sockets \
        exif \
    && pecl install mcrypt && docker-php-ext-enable mcrypt \
    && pecl install redis && docker-php-ext-enable redis

# Install Xdebug
RUN apt-get update && apt-get install -y \
    && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug

# Install Imagick
RUN apt-get update && apt-get install -y \
    imagemagick libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www
