#syntax=docker/dockerfile:1.4

# Versions
FROM php:8.2-fpm-alpine AS php_upstream
FROM mlocati/php-extension-installer:2 AS php_extension_installer_upstream
FROM composer/composer:2-bin AS composer_upstream


# The different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target


# Base PHP image
FROM php_upstream AS php_base

WORKDIR /var/www

# persistent / runtime deps
# hadolint ignore=DL3018
RUN apk add --no-cache \
		acl \
		fcgi \
		file \
		gettext \
		git \
        curl \
	;

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=php_extension_installer_upstream --link /usr/bin/install-php-extensions /usr/local/bin/

RUN set -eux; \
        install-php-extensions \
        gd \
        apcu \
        intl \
        opcache \
        zip \
    ;

RUN mkdir -p /var/run/php

#RUN chmod +x /usr/local/bin/docker-healthcheck
#
#HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]
#
#RUN chmod +x /usr/local/bin/docker-entrypoint
#
#ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer_upstream --link /composer /usr/bin/composer


# Dev PHP image
FROM php_base AS php_dev

ENV APP_ENV=dev XDEBUG_MODE=off

RUN chown -R www-data:www-data /var/www

RUN set -eux; \
    install-php-extensions \
      xdebug \
    ;

WORKDIR /var/www

RUN composer require --dev phpunit/phpunit
RUN composer require --dev friendsofphp/php-cs-fixer

EXPOSE 9000

CMD ["php-fpm"]
