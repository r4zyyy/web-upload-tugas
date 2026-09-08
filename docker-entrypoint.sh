#!/bin/bash
set -e

# Configure Apache to listen on Render's dynamic PORT
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Ensure storage link and database setup
php artisan storage:link || true
touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Run database migrations & seeders (17 meetings)
php artisan migrate --force --seed

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache web server
exec apache2-foreground
