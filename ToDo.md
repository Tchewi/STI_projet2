Améliorations du code:

- [x] Ajout d'une page d'index redirigeant vers la page de login
- [x] Impossibilité de créer un collaborateur depuis la page de gestion des utilisateurs
- [ ] Factoriser le code (connexion BDD)


Corrections de sécurité

- [x] XSS:
    - [x] Toutes les pages qui utilisent le paramètre GET error sont vulnérables à une injection
    - [x] read_message.php
    - [x] reply.php
      - solution: https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html
    - [ ] XSS stockées : les variables affichées qui proviennent de la DB
- [ ] Injections SQL:
    - [ ] read_message.php
    - [ ] préparer TOUTES les requêtes
      - https://www.php.net/manual/en/sqlite3.prepare.php
- [ ] CSRF: ajouter des tokens sur tous les formulaires (donc toutes les pages en fait)
- [ ] Configurer le CORS
- [ ] Flag HttpOnly sur le cookie de session
- [ ] Attribut SameSite sur le cookie de session
- [ ] X-Powered-By à désactiver --> serveur
- [ ] Hasher les mots de passe sur la base de données
- [ ] Check les redirections
- [ ] Vérifier la présence des paramètres à récup avec isset(...)

Questions à poser:

- Protéger du XSS stocké avant de stocker ou avant d'afficher ?

Améliorations visuelles:

-   [x] Ajouter Framework CSS (https://athemes.com/collections/best-css-frameworks/)