#!/bin/sh
set -eu

cd "${FACTORIA_APP_ROOT:-/var/www/html}"
if [ ! -f .env ]; then
  cp .env.example .env
fi
# Compose can import APP_KEY as an empty process variable. Laravel gives that
# variable precedence over .env, so expose the effective key to PHP-FPM itself.
# storage is a named volume: the generated key survives container recreation.
if [ -z "${APP_KEY:-}" ]; then
  factoria_key_dir="storage/app/factoria"
  factoria_key_file="$factoria_key_dir/app-key"
  mkdir -p "$factoria_key_dir"
  if [ ! -s "$factoria_key_file" ]; then
    (umask 077; php -r 'echo "base64:" . base64_encode(random_bytes(32));' > "$factoria_key_file")
  fi
  APP_KEY="$(cat "$factoria_key_file")"
  export APP_KEY
fi

exec "$@"
