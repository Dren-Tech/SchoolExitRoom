#!/bin/sh
docker-compose up -d

symfony server:start -d
symfony run -d yarn encore dev --watch