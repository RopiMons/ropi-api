FROM php:7.4-fpm-alpine

# Apk install
RUN apk --no-cache update && apk --no-cache add bash git yarn


# Install pdo
RUN docker-php-ext-install pdo_mysql

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN git config --global user.name "Fabian Dortu" && \
	git config --global user.email fdortu@fastmail.net


WORKDIR /var/www/html

CMD cd ropi-api && yarn && yarn dev 
CMD symfony server:start -d