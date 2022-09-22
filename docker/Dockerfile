FROM php:8.1-fpm-alpine

ARG PORT
ENV PORT=${PORT}

RUN apk update && apk add --update nodejs npm \
  composer php-pdo_sqlite php-pdo_mysql php-pdo_pgsql php-simplexml php-fileinfo php-dom php-tokenizer php-xml php-xmlwriter php-session \
  openrc bash nginx

RUN docker-php-ext-install pdo pdo_mysql

#COPY --chown=www-data:www-data web /app
WORKDIR /app

# Overwrite default nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

EXPOSE 8085

COPY entrypoint.sh /docker/entrypoint.sh
ENTRYPOINT [ "/docker/entrypoint.sh" ]
