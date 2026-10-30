ARG PHP_VERSION=8.4
FROM node:24 AS assets
FROM php:${PHP_VERSION}-fpm-bookworm

COPY --from=assets /usr/local/bin/node /usr/local/bin/node
COPY --from=assets /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && apt-get update \
    && apt-get install -y --no-install-recommends git unzip libcurl4-openssl-dev libicu-dev libxml2-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" bcmath curl gd intl mbstring pdo_mysql soap zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ARG NEXOPOS_VERSION=6.3.0
WORKDIR /var/www/html
RUN composer create-project blair2004/nexopos . "${NEXOPOS_VERSION}" --prefer-dist --no-interaction \
    && npm ci --no-audit --no-fund \
    && npm run build \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/php/entrypoint.sh /usr/local/bin/factoria-entrypoint
RUN chmod +x /usr/local/bin/factoria-entrypoint
ENTRYPOINT ["factoria-entrypoint"]
CMD ["php-fpm"]
