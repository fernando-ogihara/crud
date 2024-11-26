# Use official PHP image as base image
FROM php:8.1-apache

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Set working directory
WORKDIR /var/www/html

# Copy the application code to the container
COPY . .

# Install composer for managing PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies via Composer
RUN composer install

# Expose port 80 to the outside world
EXPOSE 80

# Start the Apache service
CMD ["apache2-foreground"]
