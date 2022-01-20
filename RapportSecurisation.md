# Rapport de sécurisation de l'application

## Corrections de sécurité

- [x] XSS:
    - [x] Toutes les pages qui utilisent le paramètre GET error sont vulnérables à une injection
    - [x] read_message.php
    - [x] reply.php
      - solution: https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html
- [x] Injections SQL:
    - [x] préparer TOUTES les requêtes
      - indiquer le type si besoin (par exemple SQLITE3_INTEGER pour les ID) 
      - https://www.php.net/manual/en/sqlite3.prepare.php
- [x] CSRF: ajouter des tokens sur tous les formulaires (donc toutes les pages en fait)
  - sources: 
    - https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html
    - https://www.phptutorial.net/php-tutorial/php-csrf/
    - `<input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : '' ?>">`
    - `verify_csrf()`
- [x] Changer le mot de passe de phpliteadmin
- [x] Flag HttpOnly sur le cookie de session
- [x] Hasher les mots de passe sur la base de données
- [x] Check les redirections
- [x] Vérifier la présence des paramètres récupérés depuis le client
- [x] Code exécuté après redirection (lorsque erreur de connexion à
- la DB)
- [x] Quand on change de mot de passe on peut voir le mot de passe
- [x] Bloquer après 10 tentatives de login
- [x] Politique de mots de passe
  - la politique est: 
    - minimum 8 charactères;
    - au moins une majuscule, une minuscule, un chiffre et un caractère spécial (#$^+=!*()@%&).
## Améliorations à faire dans le serveur: (donc pas dans ce projet)

- X-Powered-By à désactiver
- Cacher la version du serveur sur les pages d'erreur Nginx
- Attribut SameSite sur le cookie de session
  - Pas possible avec PHP 5.6, c'est pourquoi il faut modifier la config du serveur Nginx
- Configurer l'envoi du header CSP par Nginx
- Configurer le CORS dans la config de Nginx
  - https://enable-cors.org/server_nginx.html
- Utiliser une base de données protégée par mot de passe
- Configurer HTTPS et l'attribut Secure sur le cookie de session


## Améliorations autres:

- [x] Factoriser en partie le code
  - pas tout fait mais c'est déjà mieux
- [x] Ajouter Framework CSS (https://athemes.com/collections/best-css-frameworks/)
  - Sur le serveur
- [x] Ajout d'une page d'index redirigeant vers la page de login
- [x] Impossibilité de créer un collaborateur depuis la page de gestion des utilisateurs
- [x] Factoriser le code (connexion BDD)