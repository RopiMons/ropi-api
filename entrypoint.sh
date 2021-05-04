#!/bin/sh
composer self-update
composer upgrade
composer install
yarn add force
yarn dev
yes | php bin/console doctrine:migrations:migrate
yes | php bin/console doctrine:fixtures:load
symfony server:ca:install
symfony server:start
tail -F /dev/null
