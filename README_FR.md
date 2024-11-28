# QCM Sprint DEV

Ce projet est une application web interactive développée dans le cadre de la matière **Sprint DEV**. Elle permet aux utilisateurs de répondre à des questionnaires à choix multiples (QCMs), d'accéder à leurs statistiques, et offre des fonctionnalités avancées pour les administrateurs.

## Fonctionnalités principales

### Pour les utilisateurs :
- Inscription et connexion sécurisées.
- Participation à des QCMs avec calcul de score.
- Historique des résultats affiché sous forme de tableau.
- Calcul de la moyenne des scores obtenus.

### Pour les administrateurs :
- Recherche des résultats par utilisateur.
- Consultation de l'historique global des résultats.

## Technologies utilisées
- **Backend** : PHP (avec PDO pour les interactions avec la base de données).
- **Base de données** : MySQL (tables pour les utilisateurs, résultats et questions).
- **Frontend** : HTML5, CSS3, JavaScript.
- **Mode sombre** : Prise en charge du mode sombre via `prefers-color-scheme`.

## Installation

### Pré-requis
- Serveur web compatible avec PHP (par exemple : XAMPP, WAMP, MAMP).
- Base de données MySQL.

### Étapes
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-nom-utilisateur/qcm-sprintdev.git
   ```
2. Placez le dossier dans le répertoire racine de votre serveur web.
3. Importez le fichier SQL dans votre base de données :
   - Le fichier `database/qcm.sql` contient la structure et les données initiales.
   - Importez-le via phpMyAdmin ou un outil similaire.
4. Configurez la connexion à la base de données dans le fichier `includes/db.php` :
   ```php
   $host = 'localhost';
   $dbname = 'qcm';
   $username = 'root';
   $password = '';
   ```
   Modifiez ces valeurs selon votre configuration.

5. Accédez à l'application via votre navigateur :
   - URL par défaut : `http://localhost/qcm-sprintdev/`

## Arborescence du projet
```
qcm-sprintdev/
│
├── css/
│   └── style.css        # Fichier de styles (light et dark mode inclus)
├── database/
│   └── qcm.sql          # Fichier SQL pour la structure et les données
├── includes/
│   └── db.php           # Fichier de connexion à la base de données
├── js/
│   └── script.js        # Scripts JavaScript (si applicable)
├── views/
│   ├── home.php         # Page d'accueil après connexion
│   ├── quiz.php         # Page pour répondre aux QCMs
│   ├── results.php      # Page des résultats du QCM en cours
│   ├── my_results.php   # Page des résultats personnels (moyenne et historique)
│   ├── admin.php        # Espace administrateur
│   ├── login.php        # Page de connexion
│   └── register.php     # Page d'inscription
├── index.php            # Redirection vers la page d'accueil
└── README.md            # Documentation du projet
```

## Fonctionnalités à venir
- Amélioration des statistiques avec des graphiques interactifs.
- Possibilité d'ajouter/modifier des questions par les administrateurs.

## Auteurs
- **Lukas Mauffré** - Développeur principal.

## Licence
Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.


# qcm-sprintdev
 
Mettre :
- Inscription
- Connexion
- Stockage des résultats, il faut une table : note, nom, date
- Affichage de la moyenne
- Affichage de ses résultats (total)
- L'Admin peut voir tous les résultats + recherche