FROM php:8.1-fpm-alpine

ARG PORT
ENV PORT=${PORT}

RUN apk update && apk add --update nodejs npm \
  composer php-pdo_sqlite php-pdo_mysql php-pdo_pgsql php-simplexml php-fileinfo php-dom php-tokenizer php-xml php-xmlwriter php-session \
  openrc bash nginx git supervisor

RUN docker-php-ext-install pdo pdo_mysql

# Install redis
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && apk del pcre-dev ${PHPIZE_DEPS} \
  && rm -rf /tmp/pear

#COPY --chown=www-data:www-data web /app
WORKDIR /app

# Overwrite default nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

EXPOSE 8085

COPY entrypoint.sh /docker/entrypoint.sh
ENTRYPOINT [ "/docker/entrypoint.sh" ]

COPY ./supervisord.conf /etc/supervisor/conf.d/
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
