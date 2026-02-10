# 🎓 Mini Projet PHP - Gestion des Stagiaires

Bienvenue sur le **Système de Gestion des Stagiaires**, une application web développée en PHP natif pour gérer facilement les informations des stagiaires, leurs spécialités, niveaux et langues maîtrisées.

Ce projet a pour but de fournir une interface intuitive et propre pour l'administration des données scolaires ou de formation.

---

## 📸 Aperçu du Projet

> *Espace réservé pour vos captures d'écran. Remplacez les liens ci-dessous par vos images.*

### 🏠 Page d'Accueil
![Page d'Accueil](./captures/accueil.png)
*Tableau de bord principal.*

### 📋 Liste des Stagiaires
![Liste des Stagiaires](./captures/liste_stagiaires.png)
*Vue d'ensemble des stagiaires inscrits avec options de filtrage.*

### ➕ Ajout d'un Stagiaire
![Formulaire Ajout](./captures/ajout_stagiaire.png)
*Formulaire d'inscription avec validation.*

### 🖨️ Impression PDF
![Aperçu PDF](./captures/impression_pdf.png)
*Fonctionnalité de génération de fiches stagiaires au format PDF.*

---

## ✨ Fonctionnalités Principales

- **Gestion des Stagiaires (CRUD)** : Ajouter, modifier, supprimer et lister les stagiaires.
- **Gestion des Tables de Référence** :
  - **Spécialités** (Filières)
  - **Niveaux** d'études
  - **Langues** parlées
- **Recherche et Filtrage** : Trouver rapidement des informations spécifiques.
- **Génération de PDF** : Imprimer les détails d'un stagiaire (utilise DomPDF).
- **Interface Responsive** : Adaptée aux ordinateurs et tablettes grâce à Bootstrap 5.
- **Validation des Formulaires** : Vérification des données côté client et serveur.

---

## 🛠️ Technologies Utilisées

Ce projet est construit avec des technologies web standards et robustes :

- **Backend** : PHP 8.x
- **Base de Données** : MySQL
- **Frontend** :
  - HTML5 & CSS3
  - **Bootstrap 5** (Framework CSS pour le design)
  - **FontAwesome** (Icônes)
  - JavaScript (Validation et interactivité)
- **Outils** :
  - **DomPDF** (Génération de fichiers PDF)

---

## 🚀 Installation et Configuration

Suivez ces étapes pour lancer le projet localement :

### 1. Prérequis
- Un serveur web local (WAMP, XAMPP, Laragon, ou MAMP).
- PHP 8.0 ou supérieur.
- MySQL.

### 2. Installation des Fichiers
Clonez ou téléchargez ce dépôt dans le dossier racine de votre serveur web (ex: `www` pour WampServer ou `htdocs` pour XAMPP).

```bash
git clone https://github.com/votre-utilisateur/mini-projet-php.git
```

### 3. Configuration de la Base de Données
1. Ouvrez **phpMyAdmin**.
2. Créez une nouvelle base de données (si nécessaire, le script peut le faire).
3. Importez le fichier `mini_projet.sql` situé à la racine du projet.
   - Ce script créera la base de données `mini_projet_php` et toutes les tables nécessaires (`stagiaire`, `specialite`, `niveaux`, `langue`, `langue_stagiaire`).
   - Il insérera également des données de test.

### 4. Configuration de la Connexion
Vérifiez les paramètres de connexion dans le fichier `includes/connexion.php` :

```php
$host = "localhost";
$user = "root";
$password = ""; // Mettre votre mot de passe si nécessaire
$base_de_donnne = "mini_projet_php";
```

### 5. Lancer l'Application
Ouvrez votre navigateur et accédez à :
`http://localhost/Mini_projet/`

---

## 📂 Structure du Projet

```
Mini_projet/
├── assets/             # Fichiers CSS et images
├── includes/           # Fichiers PHP réutilisables (header, footer, connexion)
│   ├── dompdf/         # Librairie pour génération PDF
│   └── ...
├── pages/              # Pages de contenu spécifique (par entité)
│   ├── stagiaire/      # Gestion des stagiaires
│   ├── niveau/         # Gestion des niveaux
│   └── ...
├── traitements/        # Scripts de traitement des formulaires (ajout, modif, suppr)
├── vendors/            # Librairies externes (Bootstrap, FontAwesome)
├── index.php           # Point d'entrée principal (Routeur)
├── mini_projet.sql     # Script SQL d'importation
└── README.md           # Documentation du projet
```

---

## 👤 Auteur

**Ibrahim Sabo**
- GitHub: [Votre Profil GitHub](https://github.com/votre-profil)

---

*Fait avec ❤️ pour l'apprentissage du développement Web.*
