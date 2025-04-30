# TerrainBooker - Plateforme de Réservation de Terrains Sportifs

## Introduction

`TerrainBooker est une application web conçue pour simplifier la réservation de terrains sportifs, ciblant les écoles, centres sportifs, et amateurs de sports collectifs (football, basketball, etc.). Elle permet aux utilisateurs de vérifier les disponibilités, réserver des créneaux, payer en ligne, et laisser des avis. Les administrateurs peuvent gérer les terrains, les réservations, les paiements, et les retours via un tableau de bord sécurisé.`

1. **Problématique**  
   `Difficulté pour les utilisateurs à trouver et réserver rapidement des terrains sportifs. Gestion manuelle des réservations chronophage, entraînant des erreurs comme les doubles réservations. Manque de centralisation des informations (disponibilités, paiements, avis).`

2. **Solution**  
   `TerrainBooker propose une plateforme centralisée qui vérifie automatiquement les disponibilités des terrains en fonction des dates et heures, simplifie la réservation et le paiement en ligne, permet de laisser des avis sur les services, et offre un tableau de bord sécurisé pour les administrateurs avec un système de rôles et permissions.`

-- 

## Objectifs

`Centraliser la réservation de terrains sportifs. Simplifier la gestion des disponibilités et réservations pour les administrateurs. Offrir une expérience utilisateur fluide pour les amateurs de sport. Intégrer des paiements en ligne sécurisés et un système de feedback.`

--

## Fonctionnalités Principales

1. **Pour les Utilisateurs (Sportives)**  
    - `Vérification des disponibilités via un calendrier.` 
    - `Réservation d’un créneau et paiement sécurisé via Stripe.` 
    - `Notation et commentaire sur le service après une réservation.`
    - `Consultation et annulation des réservations via un espace utilisateur.`

2. **Pour les Administrateurs**  
    - `Attribution et modification des rôles et permissions.` 
    - `Ajout, modification, suppression des terrains, catégories, et tags.`
    - `Suivi des réservations, paiements, et feedbacks`
    - `Modération des feedbacks (publier/cacher).`

3. **Fonctionnalités Transversales**  
- `Gestion et modération des avis.`


--

## Structure du Projet

1. **Back Office (Administrateur)**  
    - `Tableau de bord avec vue globale des utilisateurs,`
    - `réservations, paiements, et feedbacks.`
    - `Gestion des utilisateurs (liste, détails, attribution des rôles/permissions).`
    - `Gestion des terrains, catégories, et tags (ajout, modification, suppression). `
    - `Suivi des réservations (statuts : confirmée, annulée, remboursée) et statistiques. `
    - `Suivi des transactions et modération des feedbacks.`

2. **Front Office (Utilisateur)**  
   - `Page d’accueil avec liste des terrains disponibles et feedbacks.`
   - `Page de recherche avec filtres (disponibilités, catégories, prix).`
   - `Page de réservation pour sélectionner un créneau,`
   - `payer via Stripe, et confirmer.` 
   - `Espace utilisateur pour suivre et annuler les réservations, et gérer le compte (nom, email,iamge, mot de passe).`

--

## Entités Principales

- `Utilisateur (User) : Sportives et administrateurs (name, email, password, profile_photo).`
- `Terrain (Terrain) : Détails des terrains (name, description, image, prix, categorie_id).` 
- `Réservation (Reservation) : Créneaux réservés (terrain_id, sportive_id, date_debut, date_fin, statut).` 
- `Feedback (Feedback) : Avis des utilisateurs (user_id, commentaire, note, status).` 
- `Paiement (Payment) : Transactions (reservation_id, amount, status, stripe_session_id). `
- `Rôle (Role) et Permission (Permission) : Gestion des accès. `
- `Categorie (Category) et Tags (Tag) : Organisation des terrains.`

--

## Technologies Utilisées

1. **Front-end** : 
- `HTML, `
- `JavaScript,`
- `Tailwind CSS (interface moderne et responsive).`
2. **Back-end** : 
- `PHP avec Laravel (gestion des services serveur).`
- `Base de données : MySQL. API externes : Stripe (paiements sécurisés),` 
- `WorldTimeAPI (gestion des fuseaux horaires), Leaflet (géolocalisation des terrains).`

--

## Prérequis

 - PHP >= 8.0, 
 - Laravel,
 - Composer, 
 - Node.js et npm, 
 - MySQL, 
 - Compte Stripe pour les paiements, 
 - Clé API WorldTimeAPI (optionnel), 
 - Clé API Leaflet (optionnel).`

--

## Installation

- `Cloner le dépôt : git clone https://github.com/mhamedaithssaine/TerrainBokker `
- `Installer les dépendances : composer install && npm install.`
- `Configurer l’environnement : cp .env.example .env, puis configurer les variables (base de données, Stripe, fuseau horaire).`
- `Générer la clé d’application : php artisan key:generate.` 
- `Créer la base de données et exécuter les migrations : php artisan migrate.`
- `Compiler les assets : npm run dev. `
- `Lancer le serveur : php artisan serve.`
- `Accéder à l’application : http://localhost:8000.`

--

## Utilisation

1. **Pour les Utilisateurs (Sportives)**  
   - `Inscrivez-vous ou connectez-vous via la page d’accueil. `
   - `Recherchez un terrain via la page de recherche (filtrez par catégorie, prix, disponibilité). `
   - `Sélectionnez un créneau horaire et procédez au paiement via Stripe. `
   - `Laissez un feedback après votre réservation depuis votre espace utilisateur. `
   - `Consultez ou annulez vos réservations dans votre espace utilisateur.`

2. **Pour les Administrateurs**  
  - `Connectez-vous avec un compte administrateur.` 
  - `Accédez au tableau de bord pour gérer les utilisateurs (attribuer des rôles/permissions), `
  - `ajouter ou modifier des terrains, catégories, et tags,` 
  - `superviser les réservations et paiements, `
  - `modérer les feedbacks (publier/cacher).`

--

## Structure des Dossiers

- `app/Models/ : Modèles Laravel (User, Terrain, Reservation, Feedback, etc.). `
- `app/Http/Controllers/ : Contrôleurs pour gérer les requêtes. `
- `resources/views/ : Vues Blade (pages front et back office). `
- `routes/web.php : Routes de l’application.`
- `public/ : Fichiers statiques (images).`

--

## Annexes

 - Maquettes : `Interfaces utilisateur disponibles dans le dossier docs/maquettes/.`
 - Diagrammes UML : `Diagrammes de cas d’utilisation et de classes dans docs/uml/.`

---

**TerrainBooker** - Simplifiez la réservation de terrains sportifs dès aujourd’hui !