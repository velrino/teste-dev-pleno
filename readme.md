# Convênia - Teste prático - DEV PHP PLENO

Este teste prático tem como objetivo demonstrar algumas boas práticas dos recursos de MVC, REST, Migrations, Queue
Onde todo tratamento de dados é feito pela Model e apenas chamado na Controller, assim simplificando e delegando as funções

Arquivo "TESTE PRATICO.postman_collection.json" é o postman de teste

Disponível remotamente em:

    http://35.167.70.207:9098/

### Optional to run:

 - Docker
	 - https://docs.docker.com/engine/installation/
 -  Image apache2, php 7 for run Laravel:
	 - docker pull velrino/lap7:lumen


    docker run -d --name=NAME -p PORT:80 --restart=unless-stopped --link=mysql57 -v $(pwd):/var/www/html velrino/lap7:lumen

----------

# Installation

    cp .env.example .env

    composer install

    php artisan migrate

    php artisan db:seed --class=SellersTableSeeder

    php artisan db:seed --class=SalesTableSeeder

# Test Unit (PHPUNIT)

    vendor/bin/phpunit -c  phpunit.xml

