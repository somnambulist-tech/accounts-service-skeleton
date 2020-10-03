
FROM somnambulist/php-ppm:7.4-latest
ENV TERM=xterm-256color
ENV PGPASSWORD=secret

RUN apk --update add ca-certificates \
    && apk update \
    && apk upgrade \
    && apk --no-cache add -U \
    php7-pdo_pgsql \
    php7-pgsql \
    php7-pecl-amqp \
    && rm -rf /var/cache/apk/* /tmp/*

# setup custom PHP ini files
COPY config/docker/test/app/conf.d/zz-custom.ini /etc/php7/conf.d/

# app will be mounted here, so set this as our working directory
WORKDIR /app

COPY config/docker/test/app/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod 755 /docker-entrypoint.sh

COPY ppm*.json ./
COPY composer.* ./
COPY .env* ./

RUN composer install --no-suggest --no-scripts --quiet && rm -rf /tmp/*

COPY . .

EXPOSE 8080

# run php-pm on the custom ip so it is externally available
CMD [ "/docker-entrypoint.sh", "start", "--workers=2", "--cgi-path=/usr/bin/php-cgi", "--host=0.0.0.0" ]
