# Use PHP with Apache
FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy all project files to Apache
COPY . /var/www/html/
