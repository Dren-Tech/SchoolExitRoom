FROM registry.gitlab.com/dren-tech/school-exit-room/caddy-php:9-create-docker-container

# run migrations

COPY . /srv/app