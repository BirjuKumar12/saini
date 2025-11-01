# Use official PHP + Apache image
FROM php:8.1-apache

# install common PHP extensions you might need (add/remove as required)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Enable apache modules needed for many PHP apps
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . /var/www/html

# If you use Composer, install it and run composer install
# (Remove if you don't use composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader --no-interaction; fi

# Ensure storage/upload directories are writable (adjust paths to your app)
# Example: if you have "uploads" and "storage" folders
RUN mkdir -p /var/www/html/uploads /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/uploads /var/www/html/storage \
    && chmod -R 775 /var/www/html/uploads /var/www/html/storage

# Copy entrypoint script and make it executable
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose a default port (Render will provide $PORT at runtime)
EXPOSE 10000

# Use entrypoint to adapt Apache listen port to Render's $PORT at runtime
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
