############################################################
# 1) Frontend builder — compile your Bootstrap/Vite assets
############################################################
FROM node:18-alpine AS builder

WORKDIR /app

# copy only package files so Docker layer cache can be effective
COPY package.json package-lock.json vite.config.js ./

# copy your raw frontend sources
COPY resources resources

# install & build
RUN npm ci
RUN npm run build   # outputs to `dist/` by default

############################################################
# 2) PHP runtime — your Laravel app
############################################################
FROM php:8.4-fpm

# install system libs + pgsql driver
RUN apk add --no-cache \
      libpq \
      git \
      unzip \
    && docker-php-ext-install pdo_pgsql

# install composer cli
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# set working dir
WORKDIR /app

# copy composer files & install
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# copy the rest of your Laravel app
COPY . .

# bring in the compiled frontend assets
COPY --from=builder /app/dist public/dist

# cache config/routes/views and fix permissions
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && chown -R www-data:www-data storage bootstrap/cache

# tell Docker (and Render) what port we’ll bind to
# actual value comes from the $PORT env var later
EXPOSE 9000

# on start: migrate (force), then serve on $PORT
ENTRYPOINT ["sh","-c"]
CMD ["php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-9000}"]
