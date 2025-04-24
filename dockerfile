FROM php:8.2-fpm

# Installer les dépendances pour PDO MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libmariadb-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-install intl \
    && apt-get clean

RUN docker-php-ext-install pdo_mysql

# Ajouter composer (si nécessaire)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
