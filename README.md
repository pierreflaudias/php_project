#Projet de création de µframework 

## Par Pierre FLAUDIAS et Antoine ALBESSARD

###Mise en route (à la racine du projet)

####Docker

    docker run -d \
    --volume /var/lib/mysql \
    --name data_mysql \
    --entrypoint /bin/echo \
    busybox \
    "mysql data-only container"
----
    docker run -d -p 3306 \
    --name mysql \
    --volumes-from data_mysql \
    -e MYSQL_USER=uframework \
    -e MYSQL_PASS=p4ssw0rd \
    -e ON_CREATE_DB=uframework \
    tutum/mysql
----
    docker ps #see mapped port
----
    mysql uframework -h127.0.0.1 -P<mapped port> -uuframework -pp4ssw0rd < app/config/schema.sql
    
    ##creation tables users et statuses
    ## injection de quelques données (user : admin, pass : admin)
####Serveur PHP
    composer install
    php -S localhost:8080 -t web/
    
----------------

###Travail effectué

#####Gestion des statuts : 

 - GET /statuses +  Filtre possible dans la requête (order by et limit)
 - GET /statuses/{id}
 - POST /statuses
 - DELETE /statuses/{id}
 - GET /statuses/{userid} : Non géré
 
#####Gestion des utilisateurs :
 - GET /login
 - POST /login
 - GET /logout
 - GET /signin
 - POST /signin
 

#####Gestion de l'authentification
 - Authentification gérée dans navigateur avec session (event dispatcher)
 - Non gérée pour API

Les POST ne sont pas gérés en Content-Type : application/json (CURL)

Response en text/html ou application/json avec Content-Negotiation

#####Tests :
 - Tests unitaires StatusMapper et StatusFinder (SQL)
 - Autres tests unitaires et tests fonctionnels non faits
