#!/bin/sh

echo "Starting Laravel application in DEVELOPMENT mode..."

# Wait for database to be ready
echo "Waiting for database connection..."
sleep 5

# Clear Laravel caches to ensure environment variables are read correctly
echo "Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear  
php artisan view:clear
php artisan cache:clear

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# 開發模式不緩存配置，以便即時看到變更
echo "Skipping configuration caching in development mode..."
# php artisan config:cache  # 開發模式下不緩存
# php artisan route:cache   # 開發模式下不緩存

# Ensure all required directories exist
echo "Creating required directories..."
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions
echo "Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Test Firebase configuration (if needed)
echo "Testing Firebase configuration..."
php artisan firebase:test-service || echo "Firebase test failed - continuing anyway"

echo "Laravel application initialization complete in DEVELOPMENT mode!"
echo "Debug mode: ENABLED"
echo "Environment: ${APP_ENV:-development}"

# Start supervisord to run nginx and php-fpm
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
