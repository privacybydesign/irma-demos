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

# The base image ships apr-util 1.6.3-3+b1, which CVE-2026-34191 flags as
# critical (SQL injection in the apr_dbd_oracle provider, a driver this image
# does not install). Pull the patched packages so the image scan passes. Drop
# this once php:8.4-apache ships them itself.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libaprutil1t64 \
        libaprutil1-ldap \
        libaprutil1-dbd-sqlite3 \
    && rm -rf /var/lib/apt/lists/*

COPY --from=builder /app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN echo "Listen 8080" >> /etc/apache2/ports.conf

RUN printf 'ErrorDocument 404 /404.php\n' > /etc/apache2/conf-enabled/error-documents.conf

EXPOSE 8080