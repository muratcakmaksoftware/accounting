FROM php:8.1.6-fpm-alpine3.16

#intl için icu-dev gereklidir
#libzip-dev zip/unzip için gerekli C kütüphaneleridir.
#opcache önceden derlenmiş olan php betiğini cacheleyip tekrar çağrıldığında hızlı cevap vermesini sağlayan teknolojidir.

#sockets rabbitmq için gereklidir.
#${PHPIZE_DEPS} redis & mongodb için gereklidir.

# Postgresql için bağımlıklar ve eklentiler
#apk add postgresql-libs postgresql-dev \
#&& docker-php-ext-install pgsql pdo_pgsql \
#&& apk del postgresql-dev

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update \
    && apk add --update --no-cache \
    bash \
    nano \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    postgresql-libs \
    postgresql-dev \
    openssh \
    ${PHPIZE_DEPS} \
    && pecl install \
    redis \
    mongodb \
    && docker-php-ext-configure \
    intl \
    && docker-php-ext-install \
    intl \
    opcache \
    pgsql \
    pdo_pgsql \
    sockets \
    && docker-php-ext-enable \
    redis \
    mongodb \
    && apk del \
    postgresql-dev ${PHPIZE_DEPS}
