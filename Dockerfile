# Dockerfile

########################################
# 1) Base image
########################################
FROM php:8.4-fpm AS base

########################################
# 2) System deps + PostgreSQL ext.
########################################
RUN apt-get update \
 && apt-get install -y \
      git \
      unzip \
      zip \
      libpq-dev \
 && docker-php-ext-install pdo_pgsql \
 && rm -rf /var/lib/apt/lists/*

########################################
# 3) Pull in Composer (v2)
########################################
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

########################################
# 4) Set workdir & copy manifests
########################################
WORKDIR /app
COPY composer.json composer.lock ./

########################################
# 5) Install PHP deps (no-dev on production)
########################################
# default APP_ENV is production
ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then \
      composer install --no-dev --no-scripts --optimize-autoloader --no-interaction; \
    else \
      composer install --no-interaction; \
    fi

########################################
# 6) Copy the rest of your code
########################################
COPY . .

########################################
# 7) Fix permissions
########################################
RUN chown -R www-data:www-data storage bootstrap/cache

########################################
# 8) Expose & run
########################################
EXPOSE 9000
CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-9000}"]