#!/bin/sh
composer install
yarn add force
yarn dev
#php bin/console doctrine:migrations:migrate
#php bin/console doctrine:fixtures:load
symfony server:ca:install
tail -F /dev/null
