FROM php:8-cli
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/project

COPY . .

RUN composer install --no-dev --no-scripts --no-autoloader \
    && composer dump-autoload --optimize

EXPOSE 8080

CMD ["php", "start.php", "start"]
