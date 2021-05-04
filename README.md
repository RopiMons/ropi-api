# Run ropi-api and ropi-frontend with docker

> CHANGELOG:
> 2021-05-03 : separate the frontend and api containers. 

## Prepare the project directory 

Howto from [https://webdevpro.net/utiliser-symfony-dans-docker/](https://webdevpro.net/utiliser-symfony-dans-docker/)

Use Docker on Windows with WSL2 backend enable (install ubuntu from Microsoft store), or use on Docker on Linux. 

Configure git in your host machine (use your own name and email!)

   	$ git config --global user.name "Fabian Dortu" 
   	$ git config --global user.email fdortu@fastmail.net

Clone the repositories `ropi-api` and `ropi-frontend` in `~project` and go to your development branch (or create a new one.)

	$ mkdir ~project
	$ cd ~project
	$ git clone https://github.com/RopiMons/ropi-api.git
	$ git checkout page_content
	$ git https://github.com/RopiMons/ropi-frontend.git
	$ git chekcout front-end-dev

## Build the docker images 

 Create the docker images from `docker-compose.yml`

	$ cd ~project
	$ cp ropi-api/docker-compose.yml .
	$ docker-compose build

If any issue to build the image, do some clean up :
> `docker stop $(docker ps -q)`
> `docker rm $(docker ps -a -q)`
> You may need to remove all the images before `docker rmi $(docker images -q)`
> If you really want to have a clean docker, then invoke `docker volume prune`

This will create 4 images :

	$ docker images
	REPOSITORY              TAG       IMAGE ID       CREATED        SIZE
	projects_php-fpm-frontend     ... 
	projects_php-fpm-api          ... 
	mysql						  ...
	phpmyadmin/phpmyadmin         ...

## Start the containers

	$ docker-compose up -d 

List the running containers

	$ docker ps
	CONTAINER ID   IMAGE                       COMMAND                  CREATED             STATUS          PORTS                              NAMES
	be7e184b1b5c   projects_php-fpm-api        "docker-php-entrypoi…"   About an hour ago   Up 15 minutes   0.0.0.0:8000->8000/tcp, 9000/tcp   projects_php-fpm-api_1
	e29c91aaf16b   projects_php-fpm-frontend   "docker-php-entrypoi…"   About an hour ago   Up 15 minutes   0.0.0.0:3000->3000/tcp, 9000/tcp   projects_php-fpm-frontend_1
	7183ae3d4c63   phpmyadmin/phpmyadmin       "/docker-entrypoint.…"   4 hours ago         Up 15 minutes   0.0.0.0:8080->80/tcp               projects_phpmyadmin_1
	55cc6e8b85e7   mysql                       "docker-entrypoint.s…"   4 hours ago         Up 15 minutes   3306/tcp, 33060/tcp                projects_mysql_1

## Execute an interactive bash in the containers

### api container

    $ docker exec -ti projects_php-fpm-api_1 bash 
    $$ symfony server:start

Open [https://localhost:8000](https://localhost:8000) in your browser to see symphony running and  [https://localhost:8000/api](https://localhost:8000/api) to see the api of ropi-api

> Note : have a look at `./entrypoint.sh` to see what has been executed when docker-compose  was launched. 
> Note :  you may need to recompile the javascript (`yarn dev`) 
> Note :  you may need to configure the mysql db fthe first time (see hereafter), and reload the fixtures after having edited them.

### frontend container

    $ docker exec -ti projects_php-fpm-frontend_1 bash 
    $$ yarn dev

Open [http://localhost:3000/](http://localhost:3000/) in your brower to see the front-end running
Page commerçants : [http://localhost:3000/commercants](http://localhost:3000/commercants)


> Have a look at `./entrypoint.sh` to see what has been  executed when docker-compose  was launched. 
>
> Note : from the this container, the api container is accessible with php-fpm-api:8000 
> in `~project/ropi-frontentdcomponents/services/ApiCaller.js`, remplace `localhost:8000` par `php-fpm-api:8000`  (the host name is given in `docker-compose.yml`).

## mysql database migration and fixtures loading

MySQL server runs in the mysql container and can be accedded on [localhost:8080](http://localhost:8080). You can obtain the mysql version from there (which you need for configuring .env.local).   

Edit `ropi-api/.env.local` to match the database login info (user name/ password / database name and mysql version)
	
	$ cp .env .env.local
	$ vi .env.local
	DATABASE_URL=mysql://root:ropipass@mysql:3306/dbropi?serverVersion=8.0.23

Execute the api container 

	$ docker exec -ti projects_php-fpm-api_1 bash

Check if the setting are correct by invoking (if you get the error that the db exists, it's fine!)

    $$ cd ropi-api
    $$ php bin/console doctrine:database:create

In case of problem, remove the db and create it again

    $$ php bin/console doctrine:database:drop --force

Migrade db et load the data

    $$ php bin/console doctrine:migrations:migrate 
    $$ php bin/console doctrine:fixtures:load 

## Edit the static content of the site

- Menu niv0(titre du menu) `ropi-api/src/CategorieFixtures.php`
- Menu niv1(sous-menu) = page  `ropi-api/src/PageStatiqueFixture.php`
- Menu niv2(sous-sous menu) = paragraphe dans page = `ropi-api/src/PragrapheFixture.php`

# Use VSCode

Open another WSL bash (no docker) and invoke

	$ cd projects/ropi-api
	$ code .

# Git workflow

Work in host (not in docker)

	$ git branch my-working-branch
	$ git pull
	$ git merge the-other-branch-we-wan-to-merge-in-my-working-branch
	$ git status

and resolve the conflicts