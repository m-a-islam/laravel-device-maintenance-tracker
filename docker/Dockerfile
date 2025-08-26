# =========================================
# Stage 1: Composer dependencies
# =========================================
FROM composer:2.7 AS vendor
WORKDIR /app

# Copy only composer files from the src folder for better caching
COPY src/composer.json src/composer.lock* ./

# Install deps but skip scripts (they call artisan, which isn't present yet)
RUN composer install --no-interaction --prefer-dist --no-progress --no-scripts

# =========================================
# Stage 2: PHP runtime (PHP-FPM 8.2)
# =========================================
FROM php:8.2-fpm-alpine AS app

RUN set -eux; \
    apk add --no-cache \
      git curl icu-dev oniguruma-dev libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev \
      bash shadow; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j$(nproc) \
      pdo_mysql mbstring exif pcntl bcmath intl gd zip; \
    docker-php-ext-install opcache

WORKDIR /var/www/html

# Copy your source code from src/ into the container
COPY src/ .

# Bring vendor from the builder stage
COPY --from=vendor /app/vendor ./vendor

# Permissions
RUN set -eux; \
    addgroup -g 1000 --system www; \
    adduser -G www -u 1000 --system --disabled-password www; \
    mkdir -p storage bootstrap/cache; \
    chown -R www:www /var/www/html

USER www
EXPOSE 9000
HEALTHCHECK --interval=30s --timeout=3s --retries=3 CMD php-fpm -t || exit 1
CMD ["php-fpm", "-F"]
