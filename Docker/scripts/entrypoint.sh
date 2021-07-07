#!/bin/sh
composer self-update
composer upgrade
composer install
yarn add force
yarn dev
yes | php bin/console doctrine:migrations:migrate
yes | php bin/console doctrine:fixtures:load
yes | symfony server:ca:install
yes | symfony server:start