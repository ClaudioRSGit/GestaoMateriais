FROM php:7.4

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get install -y unzip git curl zip

COPY . /var/www
WORKDIR /var/www
RUN composer install --no-dev --no-scripts --no-progress

COPY . .

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
