FROM node:20 AS builder

RUN apt-get update && apt-get install -y \
    php \
    php-cli \
    php-zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install
RUN yarn install

RUN chmod +x build_artifacts.sh
RUN ./build_artifacts.sh

FROM php:8.4-apache

COPY --from=builder /app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN echo "Listen 8080" >> /etc/apache2/ports.conf

EXPOSE 8080