#!/usr/bin/env bash
set -e

# Default port if PORT not set (Render will set $PORT)
: "${PORT:=10000}"

# Update Apache listen port(s)
sed -ri "s/Listen [0-9]+/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:([0-9]+|80)>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-enabled/*.conf || true
sed -ri "s/:([0-9]+|80)\\/>/:${PORT}\\/g" /etc/apache2/sites-enabled/*.conf || true

# Optional: set ServerName to avoid warnings
if ! grep -q '^ServerName' /etc/apache2/apache2.conf; then
  echo "ServerName localhost" >> /etc/apache2/apache2.conf
fi

# Ensure proper permissions
chown -R www-data:www-data /var/www/html || true
chmod -R 755 /var/www/html || true

# Run Apache foreground process
exec "$@"
