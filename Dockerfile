# Build PHP Image with extension to support Lumen Framework
FROM php:apache
RUN docker-php-ext-install pdo_mysql

# Change default location of APACHE_DOCUMENT_ROOT from /var/www/html/ to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN apt-get update && apt-get install -y sed && \
    sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf