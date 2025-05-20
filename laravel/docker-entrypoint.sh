#!/bin/sh

chown -R www-data:www-data /var/www

if [ ! -L "public/storage" ]; then
  php artisan storage:link
fi

chmod 644 /var/www/html/.env
chown www-data:www-data /var/www/html/.env

php artisan key:generate --force


php artisan migrate

exec "$@"
