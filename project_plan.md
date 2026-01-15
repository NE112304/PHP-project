# 🚗 AutoRent - Système de Gestion de Flotte Premium

Bienvenue sur **AutoRent**, une application de gestion de location de voitures de pointe construite avec **Symfony 7** et stylisée avec un **Thème Automobile Premium** personnalisé.

Ce document décrit le plan complet du projet, l'architecture technique et le parcours étape par étape de sa création.

## 📋 1. Aperçu du Projet

**Objectif** : Fournir une interface de luxe pour gérer une entreprise de location de voitures.
**Fonctions Principales** :
1.  **Gestion des Clients** : maintenir un répertoire de clients VIP.
2.  **Gestion de la Flotte** : suivre la disponibilité des véhicules, les prix et leur état.
3.  **Contrats de Location** : créer et gérer des contrats de location avec calcul automatique des prix.
4.  **Tableau de Bord** : une vue holistique de l'activité avec des actions rapides.

## 🏗️ 2. Architecture Technique

*   **Framework** : [Symfony 7.x](https://symfony.com) (PHP)
    *   Utilise l'architecture **MVC** (Modèle-Vue-Contrôleur).
*   **Base de Données** : **SQLite** (stockée dans `var/data.db`)
    *   Gérée via **Doctrine ORM** (Object-Relational Mapping).
*   **Frontend** :
    *   **Twig** : Le moteur de template pour le rendu HTML.
    *   **Bootstrap 5** : Pour la grille responsive et les composants de base.
    *   **CSS Personnalisé** : `public/css/app.css` implémente le thème "Glassmorphism" & "Dark/Neon".
*   **Serveur** : Serveur Web Local Symfony.

## 🗄️ 3. Schéma de la Base de Données (Les "Modèles")

Nous avons trois Entités principales (tables dans la base de données) :

### 1. `Vehicule` (La Flotte)
*   **id** : Identifiant unique.
*   **marque** : ex: "Bentley", "Mercedes".
*   **modele** : ex: "Continental GT".
*   **immatriculation** : Chaîne unique.
*   **prixParJour** : Tarif journalier (en DH).
*   **disponible** : Booléen (Oui/Non).
*   **etat** : Statut (ex: "Excellent", "Maintenance").
*   **caution** : Montant du dépôt de garantie (en DH).

### 2. `Client` (Les Clients)
*   **id** : Identifiant unique.
*   **nom**.
*   **prenom**.
*   **email** : Email de contact.
*   **telephone** : Téléphone de contact.
*   **numeroPermis** : Numéro du permis de conduire.

### 3. `Location` (Les Locations)
*   **id** : Identifiant unique.
*   **dateDebut** : Début de la location.
*   **dateFin** : Fin de la location.
*   **prixTotal** : Coût total calculé (en DH).
*   *Relations* : (Portée future : lié à `Client` et `Vehicule`).

### 4. `User` (Sécurité)
*   **email** : Nom d'utilisateur pour la connexion.
*   **roles** : Rôles de permission (ex: `ROLE_USER`).
*   **password** : Jeton de sécurité haché.

## 🚀 4. Parcours de Création Étape par Étape

Voici exactement comment ce projet a été construit, étape par étape :

### Phase 1 : Fondation & Configuration
1.  **Initialisation** : Exécution de `composer create-project symfony/skeleton mini_app` pour télécharger les fichiers de base.
2.  **Paquets** : Installation des paquets essentiels Maker Bundle, Twig, Doctrine et Security (`composer require webapp`).
3.  **Connexion Base de Données** : Configuration de `.env` pour utiliser `DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"`.

### Phase 2 : Construction de la Structure de Données (Backend)
4.  **Création des Entités** : Utilisation de `php bin/console make:entity` pour créer `Client`, `Vehicule`, et `Location`.
5.  **Génération CRUD** : Utilisation de `php bin/console make:crud` pour générer automatiquement les Contrôleurs, Formulaires et Templates pour les trois entités.
6.  **Migration** : Exécution de `php bin/console doctrine:schema:update --force` pour créer les tables dans la base SQLite.

### Phase 3 : Sécurité & Accès
7.  **Système Utilisateur** : Création de l'entité `User` pour les administrateurs.
8.  **Authentification** : Construction d'un formulaire de Connexion (`security/login.html.twig`) et d'un système d'Inscription.
9.  **Protection** : Configuration de `security.yaml` pour exiger une connexion pour toutes les pages sauf les écrans de connexion/inscription.

### Phase 4 : La Refonte Design "Premium"
10. **Thème Global** : Création de `public/css/app.css` définissant la palette Bleu Foncé/Néon (fond `#0f172a`, accent `#00d2ff`).
11. **Template de Base** : Mise à jour de `base.html.twig` pour inclure le nouveau CSS, les polices appropriées (Outfit), et une barre de navigation effet verre (glassmorphic).
12. **Tableau de Bord** : Remplacement de la page d'accueil par défaut par un Tableau de Bord personnalisé (`templates/dashboard/index.html.twig`) avec des Cartes interactives.

### Phase 5 : Raffinement & Personnalisation
13. **Grilles de Cartes** : Conversion des tables de liste ennuyeuses dans `index.html.twig` (Véhicules/Clients/Locations) en **Mises en page Grille** modernes.
14. **Sections Héros** : Ajout d'en-têtes immersifs sur chaque page.
15. **Mise à Jour Devise** : Passage de tous les symboles financiers de l'Euro (€) au Dirham (DH).
16. **Interactivité** : Correction des liens sur le Tableau de Bord pour s'assurer que toute la carte est cliquable (`stretched-link`) et pointe vers les formulaires "Nouveau".
17. **Nettoyage** : Suppression des icônes en filigrane obstructives pour une meilleure lisibilité.

## ⚙️ 5. Comment Ça Marche (Sous le Capot)

Lorsque vous cliquez sur "Nouveau Contrat" (New Contract) sur le tableau de bord :
1.  **Route** : Symfony fait correspondre l'URL `/location/new` à la méthode `LocationController::new()`.
2.  **Contrôleur** : Crée un nouvel objet `Location` vide et construit un Formulaire (`LocationType`).
3.  **Vue** : Rend `templates/location/new.html.twig`, enveloppant le formulaire dans notre Mise en Page Premium.
4.  **Soumission** : Lorsque vous cliquez sur Enregistrer, le Contrôleur reçoit les données, vérifie la validité, les enregistre dans SQLite via l'`EntityManager`, et vous redirige vers l'Index.
