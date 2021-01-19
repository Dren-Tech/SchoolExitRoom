FROM alpine:3.13.0

ENV PHP8_VERSION=8.0.1-r0
ENV CADDY_VERSION=2.3.0-r0
ENV COMPOSER_VERSION=2.0.8-r0

# install PHP
RUN apk update && apk add --no-cache php8=$PHP8_VERSION php8-fpm=$PHP8_VERSION

# install PHP extension
RUN apk update && apk add --no-cache php8-curl php8-iconv php8-intl php8-pdo php8-pdo_pgsql php8-pgsql php8-sodium php8-xml php8-pecl-redis

# install composer
RUN apk update && apk add --no-cache composer=$COMPOSER_VERSION

# install Caddy
RUN apk update && apk add --no-cache caddy=$CADDY_VERSION

# add Caddyfile
COPY Caddyfile /etc/caddy

# create app environment
RUN mkdir -p /srv/app
WORKDIR /srv/app
COPY . /srv/app

CMD php-fpm8 && caddy run