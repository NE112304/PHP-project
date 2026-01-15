# Rapport de Mini-Projet : Application Web de Gestion de Location de Voitures "AutoRent"

---

## 🧾 1. Page de Garde

**ÉTABLISSEMENT** : [EMSI]
**FILIÈRE / MODULE** : Framework PHP

<br><br><br>

# TITRE DU PROJET : AutoRent
## Système de Gestion de Flotte et de Réservations

<br>

**TECHNOLOGIES UTILISÉES** :
*   Framework : Symfony 8
*   Langage : PHP 8.2
*   Base de données : SQLite / Doctrine ORM
*   Moteur de template : Twig
*   Interface : Bootstrap 5 & CSS Personnalisé

<br><br>

**RÉALISÉ PAR** : Nisrine Ech-Chtouki et Najlae Sakout 
**ENCADRÉ PAR** : Mme Hidila Zined

<br><br><br>

**ANNÉE UNIVERSITAIRE** : 2025 - 2026

---

## 📑 2. Table des Matières

1.  Page de Garde
2.  Table des Matières
3.  Introduction Générale
4.  Problématique & Analyse des Besoins
5.  Objectifs du Projet
6.  Choix Techniques & Architecture
7.  Méthodologie de Développement
8.  Description Fonctionnelle de l'Application
9.  Sécurité & Validation
10. Résultats & Captures
11. Difficultés Rencontrées & Solutions
12. Conclusion & Perspectives
13. Bibliographie / Références

---

## 📝 3. Introduction Générale

Le secteur de la location de voitures est un domaine concurrentiel où la réactivité et la qualité de service sont primordiales. Les agences de location, qu'elles soient locales ou internationales, doivent gérer une multitude d'informations au quotidien : disponibilité des véhicules, dossiers clients, contrats de location, suivi des paiements et maintenance de la flotte.

Dans un contexte où la transformation numérique est devenue une nécessité, la gestion manuelle (papier ou tableurs Excel) montre rapidement ses limites : risques d'erreurs, perte de temps, difficultés d'accès à l'information et manque de visibilité sur l'activité globale.

C'est dans cette optique que s'inscrit le projet **AutoRent**. Il s'agit d'une application web développée avec le framework Symfony, visant à centraliser et automatiser les processus métiers d'une agence de location. Ce projet a pour ambition de fournir une solution clé en main, robuste et sécurisée, tout en offrant une expérience utilisateur (UX/UI) moderne et professionnelle.

Ce rapport détaille l'ensemble du cycle de vie de ce projet, de l'analyse des besoins à la mise en œuvre technique, en passant par les choix architecturaux et les défis rencontrés.

---

## ❓ 4. Problématique & Analyse des Besoins

### 4.1. Constat de l'existant et Problèmes
De nombreuses petites et moyennes agences gèrent encore leur activité de manière artisanale. Cette approche engendre plusieurs dysfonctionnements :
*   **Redondance des données** : Les informations clients sont souvent ressaisies à chaque contrat.
*   **Erreurs de facturation** : Le calcul manuel des coûts de location (nombre de jours * prix unitaire) est source d'erreurs humaines.
*   **Conflits de réservation** : Sans système centralisé, il est difficile de savoir en temps réel si un véhicule est disponible, menant au surbooking.
*   **Manque de sécurité** : Les données sensibles des clients (pièces d'identité, coordonnées) sont souvent stockées sans protection adéquate.

### 4.2. Besoins Fonctionnels
Pour répondre à ces problématiques, l'application doit couvrir les besoins suivants :
*   **Gestion des Clients** : Création, modification et consultation des fiches clients (identité, permis, contact).
*   **Gestion de la Flotte (Véhicules)** : Suivi détaillé des voitures (Marque, Modèle, Immatriculation, Prix, État, Disponibilité).
*   **Gestion des Locations** : Création de contrats associant un client à un véhicule sur une période donnée.
*   **Calcul Automatique** : Le système doit calculer automatiquement le prix total en fonction de la durée.
*   **Tableau de Bord** : Une vue synthétique permettant à l'administrateur de voir l'état de son parc et d'accéder rapidement aux fonctions clés.

### 4.3. Besoins Non-Fonctionnels
*   **Ergonomie** : L'interface doit être intuitive, moderne et responsive (adaptée aux mobiles).
*   **Performance** : Le chargement des pages doit être rapide, même avec une base de données remplie.
*   **Sécurité** : L'accès au back-office doit être restreint aux utilisateurs authentifiés. Les mots de passe doivent être hachés.
*   **Maintenabilité** : Le code doit être structuré et documenté pour permettre des évolutions futures.

---

## 🎯 5. Objectifs du Projet

### 5.1. Objectif Général
Concevoir et développer une application web "Full Stack" performante pour la gestion locative automobile, en appliquant les bonnes pratiques de développement du framework Symfony.

### 5.2. Objectifs Spécifiques
*   Mettre en place une architecture MVC (Modèle-Vue-Contrôleur) propre.
*   Utiliser un ORM (Doctrine) pour interagir avec la base de données sans écrire de SQL brut.
*   Implémenter un système d'authentification robuste (Symfony Security Bundle).
*   Créer une interface utilisateur ("Premium Theme") qui se démarque des interfaces d'administration standards.
*   Gérer les cas d'erreurs et les contraintes de validation (ex: dates cohérentes, champs obligatoires).

### 5.3. Résultats Attendus
À l'issue du projet, nous attendons une application fonctionnelle déployable en local, permettant à un agent de location de gérer son activité de A à Z sans recourir à des outils externes.

---

## 🛠️ 6. Choix Techniques & Architecture

### 6.1. Framework : Symfony 7
Le choix s'est porté sur **Symfony** pour plusieurs raisons :
*   **Robustesse et Sécurité** : C'est l'un des frameworks PHP les plus utilisés en entreprise, connu pour sa rigueur.
*   **Architecture MVC** : Il impose une séparation claire entre les données (Entités), la logique (Contrôleurs) et l'affichage (Vues Twig).
*   **Écosystème** : La présence de composants puissants comme le *Maker Bundle* (pour générer du code) et le *Security Bundle*.

### 6.2. Architecture MVC
L'application respecte le motif de conception Modèle-Vue-Contrôleur :
*   **Modèle (Model)** : Représenté par les Entités (`src/Entity`). Ce sont des classes PHP qui reflètent la structure de la base de données (User, Client, Vehicule, Location).
*   **Vue (View)** : Représentée par les templates Twig (`templates/`). Elles gèrent l'affichage HTML et l'intégration du CSS Bootstrap.
*   **Contrôleur (Controller)** : Représenté par les classes PHP (`src/Controller`). Ils reçoivent la requête utilisateur, appellent les services nécessaires et renvoient une réponse (la vue).

### 6.3. Base de Données & ORM
*   **SGBD** : **SQLite** a été choisi pour ce mini-projet pour sa légèreté et sa facilité de configuration (un simple fichier), bien qu'il puisse être facilement remplacé par MySQL ou PostgreSQL grâce à l'abstraction.
*   **Doctrine ORM** : Nous utilisons Doctrine pour manipuler les données sous forme d'objets. Cela permet de créer des requêtes complexes sans écrire de SQL et facilite la maintenance.

### 6.4. Moteur de Template : Twig
Twig offre une syntaxe concise et puissante. Il permet l'héritage de templates (brique `base.html.twig`), évitant la duplication de code pour le header, la navbar et le footer.

---

## 🔁 7. Méthodologie de Développement

Pour mener à bien ce projet, une approche itérative a été adoptée :

1.  **Initialisation & Configuration** :
    *   Installation du squelette Symfony.
    *   Configuration de l'environnement (`.env`).
    *   Mise en place de la base de données.

2.  **Modélisation des Données (Backend)** :
    *   Création des Entités (`User`, `Client`, `Vehicule`, `Location`) via la ligne de commande (`make:entity`).
    *   Définition des relations et des types de champs.
    *   Exécution des migrations pour créer le schéma physique.

3.  **Développement des Fonctionnalités (Logique)** :
    *   Génération des CRUD (Create, Read, Update, Delete) pour chaque entité.
    *   Personnalisation des Contrôleurs pour ajouter des règles métiers (ex: calcul du prix total).

4.  **Design & Intégration (Frontend)** :
    *   Développement d'un thème personnalisé `app.css`.
    *   Intégration d'un design "Glassmorphism" et d'un mode sombre.
    *   Transformation des tableaux HTML classiques en grilles de cartes modernes ("Cards").

5.  **Sécurisation & Tests** :
    *   Mise en place du formulaire de connexion.
    *   Hachage des mots de passe.
    *   Test des scénarios nominaux et des cas limites.

---

## ⚙️ 8. Description Fonctionnelle de l'Application

### 8.1. Module Authentification
Ce module est la porte d'entrée de l'application.
*   **Connexion** : Sécurisée par email et mot de passe.
*   **Inscription** : Permet de créer un compte administrateur.
*   **Protection** : Le pare-feu (Firewall) redirige systématiquement les utilisateurs non connectés vers la page de login.

### 8.2. Tableau de Bord (Dashboard)
Le centre de contrôle de l'application. Contrairement à une page d'accueil vide, il affiche :
*   Un **Hero Header** accueillant avec des boutons d'actions rapides ("Nouvelle Location", "Ajouter Client").
*   Trois cartes principales (Clients, Flotte, Locations) avec des visuels attractifs.
*   Des liens interactifs (technique `stretched-link`) permettant une navigation fluide.

### 8.3. Gestion des Véhicules (Flotte)
Permet de gérer le parc automobile.
*   **Liste (Showroom)** : Affichage visuel des voitures avec photo, prix jour (DH) et statut (disponible/maintenance).
*   **Détails** : Fiche technique complète du véhicule.
*   **Ajout/Modif** : Formulaire avec validation des champs (ex: prix positif).
*   **Particularité** : L'attribut `Caution` (anciennement problématique) est géré proprement.

### 8.4. Gestion des Locations (Contrats)
Le cœur du métier.
*   **Visualisation** : Liste des contrats avec dates, durée calculée et montant total en Dirhams.
*   **Logique Métier** : Lors de la création d'un contrat, l'administrateur sélectionne les dates. (Note: Dans une version avancée, on lierait dynamiquement le Véhicule et le Client).

---

## 🔐 9. Sécurité & Validation

### 9.1. Sécurité (Symfony Security)
*   **UserProvider** : Les utilisateurs sont stockés en base de données.
*   **PasswordHasher** : Les mots de passe ne sont jamais stockés en clair. Nous utilisons l'algorithme `auto` (souvent Bcrypt ou Argon2i) configuré dans `security.yaml`.
*   **Access Control** : Les routes `/client`, `/vehicule`, `/location` nécessitent le rôle `ROLE_USER`.

### 9.2. Validation des Données
Nous utilisons le composant *Validator* de Symfony via des attributs PHP dans les entités :
*   `#[Assert\NotBlank]` : Empêche les champs vides.
*   `#[Assert\Positive]` : Assure que les prix sont positifs.
*   `#[Assert\Length]` : Vérifie la taille des chaînes de caractères (ex: immatriculation).
*   **CSRF Protection** : Tous les formulaires incluent un jeton CSRF pour empêcher les attaques Cross-Site Request Forgery.

---

## 📊 10. Résultats & Captures

L'application résultante offre une interface utilisateur très éloignée des standards gris et ternes des back-offices classiques.

*   **Design** : L'utilisation de dégradés sombres (`#0f172a`), de transparence ("Glassmorphism") et d'accents néon (`#00d2ff`) donne une identité "Premium" et "High-Tech" à l'agence.
*   **Fluidité** : La navigation est instantanée. Les animations CSS (`animate-fade-up`) rendent l'expérience agréable.
*   **Fonctionnalité** : Tous les processus CRUD sont opérationnels. L'utilisateur peut créer, lire, mettre à jour et supprimer des données sans erreur.

*(Espace réservé pour vos captures d'écran dans le document Word)*
*   *Capture 1 : Page de Connexion*
*   *Capture 2 : Tableau de bord*
*   *Capture 3 : Grille des véhicules*

---

## 🧠 11. Difficultés Rencontrées & Solutions

### 11.1. Conflit de Mots-clés SQL
**Problème** : Lors de la création de l'entité `Vehicule`, j'avais initialement nommé un attribut `return` (pour indiquer le montant de retour/caution). Cela a provoqué une erreur critique `Syntax error ... near 'return) VALUES`, car `RETURN` est un mot réservé dans le langage SQL.
**Solution** : J'ai dû analyser les logs d'erreur Doctrine, comprendre que le nom de colonne était invalide, et renommer cet attribut en `caution`. J'ai ensuite mis à jour l'entité, les getters/setters, les formulaires et la base de données.

### 11.2. Design et Intégration
**Problème** : Rendre les formulaires Symfony (qui sont générés automatiquement) esthétiques et cohérents avec le thème sombre.
**Solution** : J'ai utilisé la personnalisation des thèmes de formulaire Twig (`form_theme`) et j'ai enveloppé manuellement les widgets dans des classes Bootstrap personnalisées (`glass-card`, `form-control`) pour obtenir l'effet désiré.

### 11.3. Liens du Dashboard
**Problème** : Rendre toute la surface d'une carte cliquable sans casser le layout.
**Solution** : Utilisation de la classe utilitaire Bootstrap `stretched-link` sur le bouton d'action, ce qui étend la zone de clic à tout le bloc parent en position relative.

---

## 🔮 12. Conclusion & Perspectives

Ce projet a été une excellente opportunité de mettre en pratique les concepts théoriques du développement web avec Symfony. J'ai pu comprendre l'importance d'une bonne architecture (MVC) et de la rigueur nécessaire pour construire une application sécurisée.

Les objectifs initiaux sont atteints : l'application "AutoRent" est fonctionnelle, sécurisée et dispose d'un design professionnel qui valorise l'image de l'entreprise.

**Perspectives d'évolution :**
1.  **Relationnel complet** : Lier techniquement les entités `Location`, `Vehicule` et `Client` par des relations `ManyToOne` pour qu'un contrat pointe réellement vers un objet Véhicule spécifique.
2.  **Paiement en ligne** : Intégrer une API de paiement (Stripe ou PayPal) pour régler la location.
3.  **Génération PDF** : Permettre d'imprimer le contrat de location directement en PDF depuis l'application.
4.  **Statistiques avancées** : Ajouter des graphiques (Chart.js) sur le tableau de bord pour visualiser le chiffre d'affaires mensuel.

---

## 📚 13. Bibliographie / Références

1.  **Documentation Symfony** : https://symfony.com/doc/current/index.html (Référence principale pour les contrôleurs et la sécurité).
2.  **Bootstrap 5 Docs** : https://getbootstrap.com/docs/5.3/ (Pour le système de grille et les composants).
3.  **Twig Documentation** : https://twig.symfony.com/
4.  **Cours de Programmation Web** : Support de cours du module [Nom du Module].
5.  **Tutoriels Doctrine** : Pour la gestion des relations et des entités.
