#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "CREATE a sqlite DB file"
touch database/database.sqlite

echo "Running migrations..."
php artisan migrate --force

echo "Running seeds..."
php artisan db:seed --force --no-interaction

echo "Building frontend..."
apk add --update nodejs npm
npm install
npm run build