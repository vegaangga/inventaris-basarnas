# ---------- STAGE 1: Build frontend (Vite) ----------
FROM node:18 AS frontend-builder

WORKDIR /app

# Copy file untuk npm install
COPY package*.json ./
RUN npm install

# Copy semua source dan build assets Vite
COPY . .
RUN npm run build

# ---------- STAGE 2: PHP + Apache untuk Laravel ----------
FROM php:8.2-apache

# Install extension yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy source code Laravel
COPY . .

# Copy hasil build Vite dari stage pertama
COPY --from=frontend-builder /app/public/build /var/www/html/public/build

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependency PHP
RUN composer install --no-dev --optimize-autoloader

# Bersihkan & optimize (biar nggak cache aneh dari lokal)
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Permission storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Ubah DocumentRoot ke public/
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Cloud Run pakai port 8080
ENV APACHE_LISTEN_PORT=8080
RUN sed -ri -e 's!Listen 80!Listen 8080!g' /etc/apache2/ports.conf \
    && sed -ri -e 's!<VirtualHost \*:80>!<VirtualHost \*:8080>!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

CMD ["apache2-foreground"]
