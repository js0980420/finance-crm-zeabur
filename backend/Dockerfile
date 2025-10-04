FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    mysql-client \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Explicitly enable pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code first
COPY . .

# 建立 Laravel 必要可寫目錄並設定權限
RUN set -eux; \
    mkdir -p bootstrap/cache \
             storage/framework/{cache,data,sessions,views} \
             storage/logs \
             storage/framework/views; \
    chown -R www-data:www-data bootstrap storage; \
    chmod -R 775 bootstrap storage

# 設定開發環境變數
ENV APP_ENV=development
ENV APP_DEBUG=true
ENV LOG_LEVEL=debug

# Install PHP dependencies (包含開發依賴)
RUN composer install --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clear any existing Laravel cache
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/startup.sh /startup.sh
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Make startup script executable
RUN chmod +x /startup.sh

# Create required directories
RUN mkdir -p /var/log/supervisor /run/nginx /var/log/nginx

EXPOSE 8000

CMD ["/startup.sh"]
