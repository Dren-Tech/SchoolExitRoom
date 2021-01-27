FROM drentech/caddy-php

COPY . /srv/app

RUN composer install