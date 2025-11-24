FROM php:8.2-apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

# ADD THIS LINE:
COPY apache.conf /etc/apache2/conf-available/servername.conf

# ENABLE IT:
RUN a2enconf servername

COPY . /var/www/html/
