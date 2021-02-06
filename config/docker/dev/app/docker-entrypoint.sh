#!/usr/bin/env bash

set -e
cd /app

cmd="$@"

[[ -d "/app/var" ]] || mkdir -m 0777 "/app/var"
[[ -d "/app/var/cache" ]] || mkdir -m 0777 "/app/var/cache"
[[ -d "/app/var/logs" ]] || mkdir -m 0777 "/app/var/logs"
[[ -d "/app/var/run" ]] || mkdir -m 0777 "/app/var/run"
[[ -d "/app/var/run/ppm" ]] || mkdir -m 0777 "/app/var/run/ppm"
[[ -d "/app/var/tmp" ]] || mkdir -m 0777 "/app/var/tmp"

# allow for custom ppm settings
if [[ ! -f "/app/ppm.json" ]]; then
    cp "/app/ppm.dist.json" "/app/ppm.json"
fi

shopt -s nullglob
for f in /app/.env*.docker
do
	  mv $f "${f/docker/local}"
done

# applying any outstanding migrations to avoid out-of-date dbs
/app/bin/console doctrine:migrations:sync-metadata-storage
/app/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

sleep 5

# run ppm, start should receive arguments from Dockerfile
/usr/bin/ppm $cmd
