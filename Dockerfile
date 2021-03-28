FROM composer:latest as build
WORKDIR /app/
COPY composer.json composer.lock /app/
RUN composer global require hirak/prestissimo && \
    composer install --no-dev --no-scripts --no-autoloader \
    && composer dump-autoload --optimize

FROM php:8
RUN apt-get update && apt-get install -y \
    acl \
 && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/project

ENV APP_ENV=prod
ENV HTTPDUSER='www-data'

EXPOSE 8080

COPY --from=build /app/vendor /var/www/project/vendor
COPY . /var/www/project/

CMD ["composer start"]
