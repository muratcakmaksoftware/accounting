FROM nginx:1.21.6-alpine

COPY ./default.conf /etc/nginx/conf.d/

RUN apk update \
    && apk add --no-cache \
    bash \
    nano
