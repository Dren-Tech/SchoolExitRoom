FROM drentech/caddy-php

RUN composer install

COPY . /srv/app