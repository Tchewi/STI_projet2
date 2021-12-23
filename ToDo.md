Améliorations du code:

- [x] Ajout d'une page d'index redirigeant vers la page de login
- [x] Impossibilité de créer un collaborateur depuis la page de gestion des utilisateurs
- [ ] Factoriser le code (connexion BDD)


Corrections de sécurité

- [ ] XSS:
    - [ ] Toutes les pages qui utilisent le paramètre GET error est vulnérable à une injection
    - [ ] read_message.php
    - [ ] reply.php
- [ ] Injections SQL:
    - [ ] read_message.php
    - [ ] préparer TOUTES les requêtes
- [ ] CSRF: ajouter des tokens sur tous les formulaires (donc toutes les pages en fait)
- [ ] Configurer le CORS
- [ ] Flag HttpOnly sur le cookie de session
- [ ] Attribut SameSite sur le cookie de session
- [ ] X-Powered-By à désactiver  --> serveur



Améliorations visuelles:

-   [x] Ajouter Framework CSS (https://athemes.com/collections/best-css-frameworks/)