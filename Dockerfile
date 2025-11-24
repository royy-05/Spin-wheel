FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Apache config (optional)
COPY apache.conf /etc/apache2/conf-available/servername.conf
RUN a2enconf servername || true

# Copy all project files to /var/www/html
COPY . /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80

# Prevent container from stopping
CMD ["apache2ctl", "-D", "FOREGROUND"]
