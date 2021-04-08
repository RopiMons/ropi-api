# Run ropi-api and ropi-frontend with docker

## Prepare the project directory 

Howto from [https://webdevpro.net/utiliser-symfony-dans-docker/](https://webdevpro.net/utiliser-symfony-dans-docker/)

Use Docker on Windows with WSL2 backend enable (install ubuntu from Microsoft store), or use on Docker on Linux. 


Configure git in your host machine (use your own name and email!)
   
   	$ git config --global user.name "Fabian Dortu" 
        $ git config --global user.email fdortu@fastmail.net
   
Clone the repositories `ropi-api` and `ropi-frontend` in `~project` and go to your developement branch (or create a new one.)
   	
	$ mkdir ~project
	$ cd ~project
	$ git clone https://github.com/RopiMons/ropi-api.git
	$ git checkout page_content
	$ git https://github.com/RopiMons/ropi-frontend.git
	$ git chekcout front-end-dev

Copy `ropi-api/Dockerfile` and `ropi-api/docker-compose.yml` in `~projects`

	$ cp ropi-api/Dockerfile .
	$ cp ropi-api/docker-compose.yml .
   
## Build the docker image and start the container

	$ cd ~project
	$ docker-compose up -d 
      
> note : if you change the `docker-compose.yml` file, just re-run 
> `docker stop $(docker ps -q)`
> `docker rm $(docker ps -a -q)`
> `docker-compose up -d`  
> 
> To rebuild the image if the Dockerfile has been modified use `docker-compose build` or `docker-compose up --build`
> You may need to remove all the images before `docker rmi $(docker images -q)`
> If you really want to have a clean docke, then invoke `docker volume prune`
   
This will create 3 images :

	$ docker images
	REPOSITORY              TAG       IMAGE ID       CREATED        SIZE
	projects_php-fpm        latest    91470127316e   3 hours ago    164MB
	mysql                   latest    14340cbfa999   33 hours ago   546MB
	phpmyadmin/phpmyadmin   latest    5c9aca5dc2b1   2 weeks ago    477MB


## Execute an interactive bash in the container

List the running containers

	$ docker ps
	CONTAINER ID   IMAGE                   COMMAND                  CREATED          STATUS         PORTS                                                    NAMES
	4637cad8fd98   projects_php-fpm        "docker-php-entrypoi…"   7 seconds ago    Up 6 seconds   0.0.0.0:3000->3000/tcp, 9000/tcp, 0.0.0.0:80->8000/tcp   projects_php-fpm_1
	928cff3b768e   phpmyadmin/phpmyadmin   "/docker-entrypoint.…"   23 minutes ago   Up 3 seconds   0.0.0.0:8080->80/tcp                                     projects_phpmyadmin_1
	7cd0ed81d1bd   mysql                   "docker-entrypoint.s…"   23 minutes ago   Up 6 seconds   3306/tcp, 33060/tcp                                      projects_mysql_1

If no container is running (or if one is missing), restart docker-compose

	$ cd ~project
	$ docker-compose up -d 

Login into the container

    $ docker exec -ti projects_php-fpm_1 bash 

Get info on your configuration

	$ php bin/console about

Donwload dependencies

	$ composer install
	$ yarn install --force

In newer version 

	$ yarn add force

   
## Database migration and fixtures loading

MySQL server already runs on [localhost:8080](http://localhost:8080). You can obtain the mysql version from there (which you need for configuring .env.local).   
   
Edit `ropi-api/.env.local` to match the database login info (user name/ password / database name and mysql version)
	
	$ cp .env .env.local
	$ vi .env.local
	DATABASE_URL=mysql://root:ropipass@mysql:3306/dbropi?serverVersion=8.0.23
	
Check if the setting are correct by invoking (if you get the error that the db exists, it's fine!)

    $ cd ropi-api
    $ php bin/console doctrine:database:create

In case of problem, remove the db and create it again

    $ php bin/console doctrine:database:drop --force
   
Migrade db et load the data

    $ php bin/console doctrine:migrations:migrate 
    $ php bin/console doctrine:fixtures:load 
   
## Compile the javascritps

    $ cd ropi-api
    $ yarn
    $ yarn dev
    
## Start symfony server  

	$ cd ropi-api
	$ symfony server:ca:install
	$ symfony server:start
	
Open [https://localhost:8000](https://localhost:8000) in your browser to see symphony running
	
Open [https://localhost:8000/api](https://localhost:8000/api) to see the api of ropi-api
	 
## Start front-end server

Login to the same running container
	
	$ docker exec -ti projects_php-fpm_1 bash
	$ cd ropi-frontend
	$ yarn dev
	
Open [http://localhost:3000/](http://localhost:3000/) in your brower to see the front-end running
Page commerçants : [http://localhost:3000/commercants](http://localhost:3000/commercants)
   
# Edit the static content of the site

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