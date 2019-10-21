FROM php:7.2-fpm

RUN apt-get update && apt-get -y install git && apt-get -y install zip

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN  apt-get install -y libmcrypt-dev \
        libmagickwand-dev --no-install-recommends \
        && pecl install mcrypt-1.0.2 \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-enable mcrypt

# COPY composer.lock composer.json /var/www/

# COPY database /var/www/database

COPY . /var/www/

WORKDIR /var/www/

COPY .env.prod .env

RUN composer install
RUN php artisan key:generate
# RUN php artisan optimize

RUN chown -R www-data:www-data /var/www/

# php artisan migrate - RUN this manualy
# php artisan db:seed - RUN this manualy
