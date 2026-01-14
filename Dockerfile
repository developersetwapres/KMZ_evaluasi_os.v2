# ===== BASE =====
FROM php:8.4-fpm-alpine

# System dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    openldap-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        gd \
        intl \
        ldap

WORKDIR /app

# ===== COPY SOURCE =====
COPY . .

# ===== COMPOSER =====
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# ===== FRONTEND BUILD =====
RUN npm ci
RUN npm run build --no-dev --optimize-autoloader --no-interaction

# ===== PERMISSION =====
RUN chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
