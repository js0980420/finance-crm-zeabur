# syntax=docker/dockerfile:1
FROM php:8.2-fpm

LABEL "language"="php"
LABEL "framework"="laravel"

# 生產模式環境變數
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY=base64:your-app-key-here

WORKDIR /var/www

# install-php-extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

# apt dependencies and supervisor
RUN set -eux \
    && apt update \
    && apt install -y cron curl gettext git grep libicu-dev nginx pkg-config unzip default-mysql-client supervisor \
    && rm -rf /var/www/html \
    && rm -rf /var/lib/apt/lists/*

# composer and php extensions
RUN install-php-extensions @composer pdo_mysql mbstring exif pcntl bcmath gd zip opcache intl

# 生產模式 PHP 配置優化
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# nginx configuration
RUN cat <<'EOF' > /etc/nginx/sites-enabled/default
server {
    listen 8080;
    root /var/www/public;
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    index index.php index.html;
    charset utf-8;

    # 生產模式安全標頭
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
    
    # Gzip 壓縮
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/javascript application/xml+rss application/json;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_hide_header X-Powered-By;
        
        # 生產模式快取標頭
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
        gzip_static on;
    }

    # 靜態資源快取
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    error_log /dev/stderr;
    access_log /dev/stderr;
}
EOF

# supervisor configuration
RUN cat <<'EOF' > /etc/supervisor/conf.d/supervisord.conf
[supervisord]
nodaemon=true
user=root
logfile=/var/log/supervisor/supervisord.log
pidfile=/var/run/supervisord.pid

[program:php-fpm]
command=php-fpm
autostart=true
autorestart=true
stderr_logfile=/var/log/php-fmp.err.log
stdout_logfile=/var/log/php-fmp.out.log

[program:nginx]
command=nginx -g "daemon off;"
autostart=true
autorestart=true
stderr_logfile=/var/log/nginx.err.log
stdout_logfile=/var/log/nginx.out.log
EOF

# project directory
RUN chown -R www-data:www-data /var/www

COPY --link --chown=www-data:www-data --chmod=755 backend/ /var/www

RUN mkdir -p /var/www/bootstrap/cache && chown -R www-data:www-data /var/www/bootstrap/cache
RUN mkdir -p /var/www/storage/framework/{cache,sessions,views} /var/www/storage/logs && chown -R www-data:www-data /var/www/storage

# 生產模式：只安裝生產依賴
USER www-data
RUN composer install --optimize-autoloader --classmap-authoritative --no-dev --ignore-platform-req=ext-grpc

# 生產模式優化
RUN php artisan config:cache
RUN php artisan route:cache  
RUN php artisan view:cache
RUN php artisan event:cache

# 執行資料庫遷移
RUN php artisan migrate --force

USER root

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
