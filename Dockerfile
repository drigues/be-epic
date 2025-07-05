# 1) Base image
FROM php:8.4-fpm

# 2) System deps & PHP extensions
RUN apt-get update \
 && apt-get install -y \
      libpq-dev \
      zip \
      unzip \
      git \
 && docker-php-ext-install pdo_pgsql \
 && rm -rf /var/lib/apt/lists/*

# 3) Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4) Set work dir
WORKDIR /app

# 5) Copy only PHP-side manifests & install (no scripts!)
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --optimize-autoloader

# 6) Bring in the rest of your code
COPY . .

# 7) Now that artisan exists, run discovery & cache + fix perms
RUN php artisan package:discover --ansi \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && chown -R www-data:www-data storage bootstrap/cache

# 8) Open port & default command
EXPOSE 9000
CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=9000"]
