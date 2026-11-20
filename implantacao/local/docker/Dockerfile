FROM php:8.4-fpm-bookworm AS app
RUN apt-get update && apt-get install -y --no-install-recommends git unzip libpq-dev libicu-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libxml2-dev libxslt1-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j2 gd pgsql intl zip soap xsl exif opcache
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
WORKDIR /srv/moodle
RUN git clone --depth 1 --branch v5.3.1 https://github.com/moodle/moodle.git . && rm -rf .git && COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --prefer-dist --no-interaction && composer check-platform-reqs --no-dev
RUN mkdir -p /srv/moodledata && chown www-data:www-data /srv/moodledata
COPY config.php /srv/moodle/config.php
COPY moodle.ini /usr/local/etc/php/conf.d/99-moodle.ini

FROM nginx:stable-alpine AS web
COPY --from=app /srv/moodle/public /srv/moodle/public
COPY nginx.conf /etc/nginx/conf.d/default.conf
