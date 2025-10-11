# syntax=docker/dockerfile:1
FROM php:8.2-fpm

LABEL "language"="php"
LABEL "framework"="laravel"

ENV APP_ENV=production
ENV APP_DEBUG=false

WORKDIR /var/www

# install-php-extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

# apt dependencies and nginx
RUN apt update && apt install -y cron curl gettext git grep libicu-dev nginx pkg-config unzip default-mysql-client supervisor && rm -rf /var/www/html && rm -rf /var/lib/apt/lists/*

# composer and php extensions
RUN install-php-extensions @composer pdo_mysql mbstring exif pcntl bcmath gd zip opcache intl

# nginx configuration
RUN cat <<'EOF' > /etc/nginx/sites-enabled/default
server {
    listen 8080;
    root /var/www/public;
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    index index.php index.html;
    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \\.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\\.php)(/.*)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_hide_header X-Powered-By;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
        gzip_static on;
    }

    location ~ /\\.(?!well-known).* {
        deny all;
    }

    error_log /dev/stderr;
    access_log /dev/stderr;
}
EOF

# project directory
RUN chown -R www-data:www-data /var/www

COPY --link --chown=www-data:www-data --chmod=755 backend/ /var/www

# 修正 CORS 配置 - 添加 Zeabur 域名模式
RUN sed -i "/allowed_origins_patterns.*=> \\[/a\\        '/^https:\\\\/\\\\/.*\\\\.zeabur\\\\.app$/'," /var/www/config/cors.php

# install dependencies
USER www-data
RUN composer install --optimize-autoloader --classmap-authoritative --no-dev

# optimization for Laravel (跳過 view:cache，因為這是 API-only 項目)
RUN php artisan config:cache
RUN php artisan route:cache

# start services
USER root
EXPOSE 8080

CMD ["sh", "-c", "service nginx start && php-fpm"]
