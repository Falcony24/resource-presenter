#!/bin/sh

chown -R www-data:www-data /var/www

php artisan storage:link

php artisan key:generate --force

exec "$@"
