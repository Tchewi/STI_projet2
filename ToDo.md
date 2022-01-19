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
      - On a sécurisé uniquement du côté du client et pas dans la BDD
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
    - [ ] VERIFIER QUE CA FONCTIONNE
- [ ] Configurer le CORS
- [ ] Flag HttpOnly sur le cookie de session
- [ ] Attribut SameSite sur le cookie de session

- [x] Hasher les mots de passe sur la base de données
- [x] Check les redirections
- [ ] Vérifier la présence des paramètres à récup avec isset(...)
- [ ] Code exécuté après redirection

Améliorations à faire dans le serveur: (donc pas dans ce projet)

- [ ] X-Powered-By à désactiver --> serveur
- [x] Code exécuté après redirection (lorsque erreur de connexion à la DB)
- [ ] Quand on change de mot de passe on peut voir le mot de passe + pas de double vérif 

Améliorations autres:

- [x] Factorisé en partie le code
  - pas tout fait mais c'est déjà mieux
- [x] Ajouter Framework CSS (https://athemes.com/collections/best-css-frameworks/)


Remarques:

- On a sécurisé le XSS du côté du client. Idéalement il faudrait aussi le 