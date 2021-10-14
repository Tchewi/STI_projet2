# STI_projet1

## Installation

Commandes Docker :
`docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018`

`docker exec -u root sti_project service nginx start`

`docker exec -u root sti_project service php5-fpm start`

Accéder à la page principale : http://localhost:8080/login.php

    - exemple.php : un fichier php qui réalise des opérations basiques SQLite sur le fichier contenu dans le repertoire databases
    - helloworld.php : un simple fichier hello world pour vous assurer que votre container Docker fonctionne correctement
    - phpliteadmin.php : une interface d'administration pour la base de données SQLite qui se trouve dans le repertoire databases

Le mot de passe pour phpliteadmin est "admin".
