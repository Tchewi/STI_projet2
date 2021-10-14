# STI_projet1

## Installation

Commandes Docker :

`docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018`

`docker exec -u root sti_project service nginx start`

`docker exec -u root sti_project service php5-fpm start`

Accéder à la page principale : http://localhost:8080/login.php

## Important

Il faut ajouter des permissions `read` et `write` pour other au fichier `database.sqlite`, ainsi que les permissions `read`, `write` et `execute` pour other au dossier `databases`.

Un compte admin est déja crée:
* Username: Grenouille
* Passeword: phrog


Le mot de passe pour phpliteadmin est "admin".
