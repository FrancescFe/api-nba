#### ABSTRACT 
This README is the documentation of an API of nba stats.
Original DB is stored in csv files.
We will use a Docker container with doctrine to convert data to ORM.
We will configure DB to operate with MVC (although we don't use a View, we will use Symfony as endpoint with Json format).

# API-NBA SETTING

## Building our work environment

To begin with, we have to use docker to build our mysql connection & api.

1) in powershell (or whatever console) go to ```\add-env\mysql-rds\```
```
docker-compose up --build
docker network create edu-shared
docker-compose up -d
```

2) go to ```\api-nba\```
```
docker-compose up -d
```

3) open ```docker-compose.yml``` & ```.env.webapp``` and change ```sf-app``` for ```apinba```

4) inside ```\api-nba```
```
docker-compose down
docker-compose up --build
docker-compose up -d
docker-compose exec web bash

symfony new api-nba --version=4.4 --full --no-git
cd api-nba
cp .env ../
```

5) copy all folders and files (by console or GUI)

6) we can delete the outdated ```\api-nba```
```
rm -r api-nba/
```

7) go to file hosts (windows: ```\windows\system32\drivers\etc\hosts```)
```
127.0.0.1   apinba.local
```

8) go to navigator and write the URL to see if our symfony setting works properly
```
apinba.local:8082
```

![](https://i.imgur.com/68E1tdy.png)

We are ready to next step!!

## DB: from CSV to ORM

Now that we have our server connection ready we are going to prepare our DB settings.

9) open ```\api-nba``` (I used phpstorm), open ```.env``` and place this changes to config connection
```
DB_USER=root
DB_PASSWORD=dbrootpass
DB_HOST=add-dbms
DB_NAME=nba
DATABASE_URL="mysql://${DB_USER}:${DB_PASSWORD}@${DB_HOST}:3306/${DB_NAME}?serverVersion=5.7"
```

10) open ```nba_2022-02-02.sql``` write before ```drop table``` line
```
CREATE SCHEMA IF NOT EXISTS nba;
USE nba;
```

11) go back to powershell
```
mysql -u root -pdbrootpass -h add-dbms < files/nba_2022-02-02.sql
mysql -u root -pdbrootpass -h add-dbms
show databases;
use nba;
show tables;
```

12) go to MySQL workbench and create new DB config (this is just to see info of tables)
```
ip 127.0.0.1 
port 33006
```

13) write the scripts to transfer csv info to our mysql DB (I used pycharm)
> You can check my code in folder: ```\files\scripts\```

14) go to docker again 
```
exec web bash
python3 files/scripts/csv_to_mysql_equipos.py
python3 files/scripts/csv_to_mysql_jugadores.py
python3 files/scripts/csv_to_mysql_estadisticas.py
python3 files/scripts/csv_to_mysql_partidos.py
```

15) using doctrine we create entities
```
php bin/console doctrine:mapping:convert annotation src/Entity --from-database
```

16) go back to IDE and open ```\api-nba\src\Entity``` and inside each .php file write at line 3:
```
namespace App\Entity;
```
17) in same files, delete ```"\"``` from ```@var``` which have them
18) generate setters & getters and delete ID setters

## Installing some Doctrine extensions

Our Doctrine image only contains basic functions, so we are going to custom our Doctrine adding functions ```GroupConcat``` & ```DateFormat```

19) install berbelei/DoctrineExtensions ```https://github.com/beberlei/DoctrineExtensions```

20) install in our container
```
composer require berbelei/doctrineextensions
```

21) move to ```config/packages/doctrine.yaml``` & after line ```auto_mapping:true``` add (respecting tabs is mandatory)
```
dql:
    string_functions:
        group_concat: DoctrineExtensions\Query\Mysql\GroupConcat
        date_format: DoctrineExtensions\Query\Mysql\DateFormat
```

## Accessing Data
Finally, we are ready to access data and show it at an endpoint with Json format using Symfony.
22) inside src\Repository create one php class ```yourEntityNameRepository.php``` by each entity class. At line 3 write (if IDE don't auto write it) 
```
namespace App\Repository;
```
23) inside each repository define functions you need (I used dql)
24) inside src\Controller create one php class ```yourEntityNameController.php``` by each entity class. In "extends" field write ```AbstractController```. At line 3 write (if IDE don't auto write it)
```
namespace App\Controller;
```
25) Now we can create the queries we need

## Practical Cases
At last, we are going to solve some practical cases of custom queries.
These practical cases are collected in ```QuestionsProjectApiNba.pdf```.
You can see my approach to solution in ```src\Controller``` & ```src\Repository```.

### A) for each team, list all information stored
![](https://i.imgur.com/Jwd9GV0.png)

### B) given a team name, list all info on it
![](https://i.imgur.com/nMwYLKm.png)

### C) for each team, list all its players
![](https://i.imgur.com/Wna5MSv.png)

### D) given a team name, list all its players
![](https://i.imgur.com/dfnGGkB.png)

### E) for each player, list all information stored
![](https://i.imgur.com/aHGDYmG.png)

### F) given a player name, list all info on it
![](https://i.imgur.com/FkhFi4H.png)

### G) given a player name, list height(cm), weight(kg) & position
![](https://i.imgur.com/z9ix1l2.png)

### H) given a player name, show player stats
![]()

### I)
![]()

### J)
![]()

### K)
![]()

### L)
![]()

### M)
![]()