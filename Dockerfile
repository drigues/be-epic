# 1) Use PHP 8.4 FPM
FROM php:8.4-fpm

# 2) Install system deps + PostgreSQL extension
RUN apt-get update \
 && apt-get install -y \
      git \
      zip \
      unzip \
      libpq-dev \
 && docker-php-ext-install pdo_pgsql \
 && rm -rf /var/lib/apt/lists/*

# 3) Bring in Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4) Set working dir
WORKDIR /app

# 5) Copy only PHP manifest files & install deps (no scripts yet)
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --optimize-autoloader \
    --no-interaction

# 6) Copy the rest of your app
COPY . .

# 7) Run discovery, cache & fix perms
RUN php artisan package:discover --ansi \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && chown -R www-data:www-data storage bootstrap/cache

# 8) Expose port & default command
EXPOSE 9000
CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=9000"]
