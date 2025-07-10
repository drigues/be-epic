# ── ASSETS STAGE ──────────────────────────────────────────────────────────────
FROM node:20-alpine AS assets
WORKDIR /opt/app
COPY package.json package-lock.json vite.config.js ./
COPY resources resources
RUN npm ci
RUN npm run build


# ── PHP APP STAGE ─────────────────────────────────────────────────────────────
FROM php:8.4-fpm AS base

# 2) System deps + PostgreSQL extension
RUN apt-get update \
 && apt-get install -y git unzip zip libpq-dev \
 && docker-php-ext-install pdo_pgsql \
 && rm -rf /var/lib/apt/lists/*

# 3) Pull in Composer (v2)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4) Set workdir & copy composer files
WORKDIR /app
COPY composer.json composer.lock ./

# 5) Install PHP deps (no-dev in production)
ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then \
      composer install --no-dev --no-scripts --optimize-autoloader --no-interaction; \
    else \
      composer install --no-interaction; \
    fi

# ➋ Copy the built Vite assets into public/build
COPY --from=assets /opt/app/public/build public/build

# 6) Copy the rest of your application
COPY . .

# 7) Fix permissions on storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# 8) Expose port & default startup command
EXPOSE 9000
CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-9000}"]
