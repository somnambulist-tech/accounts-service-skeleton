
FROM somnambulist/php-ppm:8.0-latest
ENV TERM=xterm-256color
ENV PGPASSWORD=secret

RUN apk --update add ca-certificates \
    && apk update \
    && apk upgrade \
    && apk --no-cache add -U \
    php8-pdo_pgsql \
    php8-pgsql \
    php8-pecl-xdebug \
    && wget https://mirror.reenigne.net/alpine/edge/testing/x86_64/php8-pecl-amqp-1.11.0_beta-r0.apk \
    && apk add --allow-untrusted php8-pecl-amqp-1.11.0_beta-r0.apk \
    && rm -rf /var/cache/apk/* /tmp/*

# setup custom PHP ini files
COPY config/docker/dev/app/conf.d/zz-custom.ini *user.ini /etc/php8/conf.d/

# app will be mounted here, so set this as our working directory
WORKDIR /app

COPY config/docker/dev/app/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod 755 /docker-entrypoint.sh

COPY ppm*.json ./
COPY composer.* ./
COPY .env* ./

RUN composer install --no-scripts --quiet && rm -rf /tmp/*

COPY . .

EXPOSE 8080

# run php-pm on the custom ip so it is externally available
CMD [ "/docker-entrypoint.sh", "start", "--workers=2", "--cgi-path=/usr/bin/php-cgi8", "--host=0.0.0.0" ]
