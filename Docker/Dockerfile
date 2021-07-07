# The documentation for this dockerfile can be found on
# https://webdevpro.net/utiliser-symfony-dans-docker/
#
# This Dockerfile is used by the companion file docker-compose.yml
# which is processed by callin  `docker-compose up -d`

FROM php:8.0-fpm-alpine

# Apk install
RUN apk --no-cache update && apk --no-cache add bash git yarn


# Install pdo
RUN docker-php-ext-install pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html

#Set up script file
COPY scripts/entrypoint.sh /scripts/entrypoint.sh
RUN ["chmod", "+x", "/scripts/entrypoint.sh"]

ENTRYPOINT ["/scripts/entrypoint.sh"]