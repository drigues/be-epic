# ───────────────────────────────────────────────────────────────
# 1) Base image
# ───────────────────────────────────────────────────────────────
FROM php:8.4-fpm

# ───────────────────────────────────────────────────────────────
# 2) System dependencies & PHP extensions
# ───────────────────────────────────────────────────────────────
RUN apt-get update && apt-get install -y \
      libpq-dev \
      git \
      unzip \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# ───────────────────────────────────────────────────────────────
# 3) Install Composer
# ───────────────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ───────────────────────────────────────────────────────────────
# 4) Set working directory
# ───────────────────────────────────────────────────────────────
WORKDIR /app

# ───────────────────────────────────────────────────────────────
# 5) Install PHP dependencies
# ───────────────────────────────────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# ───────────────────────────────────────────────────────────────
# 6) Copy application code
# ───────────────────────────────────────────────────────────────
COPY . .

# ───────────────────────────────────────────────────────────────
# 7) Cache config/routes/views & fix permissions
# ───────────────────────────────────────────────────────────────
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && chown -R www-data:www-data storage bootstrap/cache

# ───────────────────────────────────────────────────────────────
# 8) Expose port & start
# ───────────────────────────────────────────────────────────────
EXPOSE 9000
CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=9000"]
