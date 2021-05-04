# The documentation for this dockerfile can be found on
# https://webdevpro.net/utiliser-symfony-dans-docker/
#
# This Dockerfile is used by the companion file docker-compose.yml
# which is processed by callin  `docker-compose up -d`

FROM php:7.4-fpm-alpine

# Apk install
RUN apk --no-cache update && apk --no-cache add bash git yarn


# Install pdo
RUN docker-php-ext-install pdo_mysql

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html/ropi-api

COPY entrypoint.sh /var/www/html/ropi-api/entrypoint.sh
RUN ["chmod", "+x", "/var/www/html/ropi-api/entrypoint.sh"]
#ENTRYPOINT ["/var/www/html/ropi-api/entrypoint.sh"]
#CMD ["symfony", "server:start"]

