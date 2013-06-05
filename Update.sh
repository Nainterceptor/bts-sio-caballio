#!/bin/bash
git pull
if [[ $1 == "full" ]]
    then
        php composer.phar update
    else
        echo "Pas mis à jour"
fi
php app/console doctrine:schema:update --force
php app/console assetic:dump
rm -rf app/cache/*
rm -rf app/logs/*