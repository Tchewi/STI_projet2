# STI_projet1

## Définition globale 
L’application  doit  permettre  la  mise  en  œuvre  d’une  messagerie  électronique  au  sein  d’une 
entreprise.  Cette  messagerie  sera  une  application  Web  uniquement  se  basant  sur  une  base  de 
données (pas de SMTP ou autres).  
La personne chargée du développement de l’application a juste reçu une liste de fonctionnalités et 
peu  de  temps  pour  la  réalisation.  Le  budget  ne  permet  donc  de  réfléchir  sur  la  sécurité.  Il  est 
Sécurité des Technologies Internet 
Projet 1  - 4 -  22.09.2021 
 
attendu qu’une deuxième équipe évalue la sécurité de l’application et la modifie quelques mois plus 
tard. 
Même l’environnement dans lequel l’application tourne risque d’être mal sécurisé. 

## Authentification 

Une authentification simple sera nécessaire afin d’accéder à l’application. Vous devez implémenter 
vous-même votre propre système d’authentification.  
- Vous  ne  pouvez  en  aucun  cas  utiliser  des  modules/paquets/frameworks/etc  vous 
permettant de simplifier la gestion d’accès et l’authentification.  
- Seule la page de login sera accessible sans être authentifié. 

## Rôles et authentification 

L’application devra proposer deux rôles différents :  
• Collaborateur, 
• Administrateur.  
Un mécanisme d’authentification simple (utilisateur – mot de passe) devra permettre d’accéder aux 
fonctionnalités. Pour pouvoir se connecter, un utilisateur devra être défini comme « actif ». 
Les fonctionnalités détaillées pour chaque rôle sont définies plus loin dans ce document. 

## Navigation 

Il devra être aisé de naviguer d’une page à l’autre, via des liens ou boutons. 
Vous  devrez  implémenter  votre  propre  système  de  navigation.  Vous  ne  pouvez  en  aucun  cas 
utiliser des modules/paquets/frameworks/etc vous permettant de simplifier la navigation. 

## Fonctionnalités 

Un collaborateur aura accès aux fonctions suivantes : 
- Lecture des messages reçus : une liste, triée par date de réception, affichera les informations 
suivantes : 
o Date de réception 
o Expéditeur 
o Sujet 
o Bouton ou lien permettant la réponse au message 
o Bouton ou lien permettant la suppression du message  
o Bouton ou lien permettant d’ouvrir les détails du message 
§ Devra permettre l’affichage des mêmes informations/options que ci-dessus, 
avec le corps du message en plus 
- Ecrire un nouveau message : rédaction d’un nouveau message à l’attention d’un autre 
utilisateur. Les informations suivantes devront être fournies : 
o Destinataire (unique) 
o Sujet  
o Corps du message 
- Changement du mot de passe : afin de pouvoir modifier son propre mot de passe 
Un administrateur aura accès aux fonctions suivantes : 
- Doit avoir les mêmes fonctionnalités qu’un Collaborateur, en plus des suivantes 
- Ajout / Modification / Suppression d’un utilisateur : un utilisateur est représenté par : 
o Un login (non modifiable) 
o Un mot de passe (modifiable) 
o Une validité (boolean, modifiable), actif ou inactif 

## Docker

Commandes :
`docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018`
`docker exec -u root sti_project service nginx start`
`docker exec -u root sti_project service php5-fpm start`

Si vous utilisez l'image Docker proposée pour le cours, vous pouvez copier directement le repertoire "site" et son contenu (explications dans la donnée du projet).

Le repertoire "site" contient deux repertoires :

    - databases
    - html

Le repertoire "databases" contient :

    - database.sqlite : un fichier de base de données SQLite

Le repertoire "html" contient :

    - exemple.php : un fichier php qui réalise des opérations basiques SQLite sur le fichier contenu dans le repertoire databases
    - helloworld.php : un simple fichier hello world pour vous assurer que votre container Docker fonctionne correctement
    - phpliteadmin.php : une interface d'administration pour la base de données SQLite qui se trouve dans le repertoire databases

Le mot de passe pour phpliteadmin est "admin".
