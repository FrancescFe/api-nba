# api-nba

// go to folder add-env\mysql-rds\
docker-compose up --build
docker network create edu-shared
docker-compose up -d

// go to folder Final project\api-nba\
docker-compose up -d

// open files "docker-compose.yml" & ".env.webapp" and change "sf-app" por "apinba"
// inside api-nba
docker-compose down
docker-compose up --build
docker-compose up -d
docker-compose exec web bash

symfony new api-nba --version=4.4 --full --no-git
cd api-nba
cp .env ../
// copy all folders and files (using -r for folders)

// to check if we have all files
cd ..
ls -la

rm -r api-nba/

// go to folder windows\system32\drivers\etc\hosts
127.0.0.1   apinba.local

chmod -R 777 var/cache/*
chmod -R 777 var/log

// go to navigator
apinba.local:8082

hystory > /tmp/comandos.txt
cat /tmp/comandos.txt

// open api-nba folder in phpstorm, open .env and config connection
DB_USER=root
DB_PASSWORD=dbrootpass
DB_HOST=add-dbms
DB_NAME=nba
DATABASE_URL="mysql://${DB_USER}:${DB_PASSWORD}@${DB_HOST}:3306/${DB_NAME}?serverVersion=5.7"

// in phpstorm, open nba_2022-02-02.sql write before "drop table" line
CREATE SCHEMA IF NOT EXISTS nba;
USE nba;

// in powershell
mysql -u root -pdbrootpass -h add-dbms < files/nba_2022-02-02.sql
mysql -u root -pdbrootpass -h add-dbms
show databases;
use nba;
show tables;

// go to MySQL workbench and create new DB config (ip 127.0.0.1 port 33006) this is just to see info of tables

// go to pycharm and write the scripts

// go to docker, exec web bash and then
python3 files/scripts/csv_to_mysql_equipos.py
python3 files/scripts/csv_to_mysql_jugadores.py
python3 files/scripts/csv_to_mysql_estadisticas.py
python3 files/scripts/csv_to_mysql_partidos.py

// using doctrine we create entities
php bin/console doctrine:mapping:convert annotation src/Entity --from-database

// go to phpstorm and open api-nba\src\Entity and inside each .php file write at line 3:
namespace App\Entity;

// in same files, delete "\" from @var which have them
// generate setters & getters and delete ID setters

// inside src\Repository create one php class ("Entityname"Repository.php) by each entity class. At line 3 write "namespace App\Repository;"
// in same files, inside each repository define functions you need with this dql syntax:

