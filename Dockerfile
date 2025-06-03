FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --no-progress

# CMD ["php-fpm"]
EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
