#!/bin/sh

chown -R www-data:www-data /var/www

if [ ! -L "public/storage" ]; then
  php artisan storage:link
fi

php artisan key:generate --force
php artisan migrate

exec "$@"
