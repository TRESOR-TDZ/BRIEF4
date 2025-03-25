Système de Gestion des Utilisateurs

Un système complet de gestion des utilisateurs avec rôles (superadmin, admin, client) et authentification sécurisée.

Fonctionnalités

- 🔐 Authentification sécurisée
- 👥 Gestion des rôles utilisateurs
- 📋 Liste des utilisateurs avec filtres
- ➕ Ajout de nouveaux utilisateurs
- ✏️ Modification des profils
- ⏱️ Historique des connexions
- 🎨 Interface moderne avec Tailwind CSS

Structure du Projet


gestionutilisateur/
├── config/
│   └── config.php
├── controller/
│   ├── AuthController.php
│   └── UserController.php
├── model/
│   └── UserModel.php
├── public/
│   ├── index.php
│   └── .htaccess
└── views/
    ├── auth/
    │   └── login.php
    └── users/
        ├── AjouterUser.php
        ├── listeUser.php
        └── ModifierUser.php

Prérequis

- PHP 8.0+
- MySQL 5.7+
- Apache/Nginx
- Composer (optionnel)

Installation

1. Cloner le dépôt :
   bash
   git clone https://github.com/votre-repo/gestionutilisateur.git
   cd gestionutilisateur
   

2. Configurer la base de données :
   - Importer le fichier SQL situé dans `database/schema.sql`
   - Configurer les accès dans `config/config.php`

3. Configurer le serveur web :
   - Pointer le document root vers le dossier `public/`
   - Activer les réécritures d'URL

4. Accès initial :
   - Identifiants superadmin par défaut :
     
     Username: superadmin
     Password: admin123
     

Configuration

Modifier les paramètres dans `config/config.php` :

php
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestionutilisateur');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', 'http://votre-domaine.com/');


Rôles et Permissions

| Rôle        | Permissions |
|-------------|-------------|
| Superadmin  | Toutes les actions + gestion des admins |
| Admin       | Gestion des clients, voir la liste des utilisateurs |
| Client      | Voir/modifier son profil seulement |

Fonctionnalités Techniques

- Sécurité:
  - Protection contre les injections SQL
  - Hashage des mots de passe (bcrypt)
  - Protection CSRF (à implémenter)
  - Gestion des sessions sécurisées

- Performance:
  - Architecture MVC optimisée
  - Requêtes SQL préparées
  - Chargement lazy des composants

Captures d'Écran

![Login Screen](screenshots/login.png)
Interface de connexion

![User List](screenshots/user-list.png)
Liste des utilisateurs

Roadmap

- [ ] Ajouter la réinitialisation de mot de passe
- [ ] Implémenter la journalisation des activités
- [ ] Ajouter des exports CSV/Excel
- [ ] Internationalisation (multi-langue)





Contact

Votre Nom - ZIGNA DUTRESSE TRESOR - zignatresor@gmail.com

Lien du projet :(https://github.com/TRESOR-TDZ/BRIEF4)