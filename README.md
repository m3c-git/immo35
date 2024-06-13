# immo35

Immo35 est un site internet pour un agent agents immobilier indépendant, qui lui permet de gérer de façon simple les biens qu'il peut avoir en location, en vente.  

Le site peut être consulté à cette adresse  : https://immo35.mawqi3creation.com/ 
Voici un compte de test avec des droits en lecture qui permet de consulter la partie d'administration du site : 
- login de connexion : hello@test.fr 
- mot de passe: IN?xsvAxhS!e5Ylh**

## Fonctionnalités
- Ajout, modification, et suppression des biens
- Ajout, modification, et suppression des propriétaires  et locataires 
- Ajout, modification, et suppression des Administrateur du site
- Authentification pour les administrateurs
- Possibilités de filtrage des biens pour les visiteurs, par statuts  (à vendre, à louer), par types (maison, appartement...) et localisation
- Formulaire  de contact
- Accès rapide au bien à louer ou à vendre

## Base de données
- MySQL : un template de la base de données est disponible sur le dépôt Git => https://github.com/m3c-git/immo35.git <!-- Demander le droits d'accès au repo avant, si besoin -->

## Technologies utilisées
**Front-end :**
- HTML 
- TWIG pour le balisage et la mise en place des template de page 
- JavaScript pour l'interaction
- SASS pour le style et les animations 
- Bootstrap pour le style 
- L'éditeur WYSIWYG TinyMCE
- JQuery pour le carrousel
- Font Google
- Font awesome icons

**Back-end :**
- PHP : v8.0.3 Langage de programmation côté serveur.
- vlucas/phpdotenv : Bibliothèque PHP pour charger les variables d'environnement à partir d'un fichier .env.

## Installation et Configuration
**Prérequis** 
- PHP 8.0.3 ou plus
- MySQL 5.7 ou plus
- Composer
- TWIG 3 ou plus 
- SASS 
- TinyMCE 7.1 ou plus 
- JQuery 3.7.1
- Filezilla

**Installation**
1. Cloner le dépôt du projet https://github.com/m3c-git/immo35.git <!-- Demander le droits d'accès au repo avant, si besoin -->
2. Récupérer à partir du dépot le fichier ".env", le fichier "composer.json"
3. Récupérer l'export de la bdd "eddyfrair_immo35_db_deploiement.sql" présent dans le repo.
4. Importer la sauvegarde de la BDD dans la nouvelle basse qui recevra le projet.
5. Mettre à jour les informations du fichier .env avec les informations de la nouvelle base de données.
6. Lancer la commande ```bash composer install ``` pour mettre à jour les dépendances.
7. Lancer la commande ```bash composer dump-autoload ``` pour mettre à jour l'autoload.
8. Adapter les liens pour correspondre avec le domaine  qui correspondra au projet en ligne.
9. Verifier si les chemins des fichiers image sont corrects. Adapter au nouvel environnement si besoin. 
10. A l'aide de Filezilla ou web ftp de l'hébergeur utilisé, copier les sources du projet sur l'hébergement en ligne (server dédié ou personnalisé).
11. Vérifier si les points 4, 5 et 6 ont bien été réalisés.
12. Tester l'accès au site et corriger les différents bug qui pourraient  être liés à la mise en ligne du projet.

## Auteur
- Eddy Ayyoub FRAIR


## Licence
Ce projet et l'ensemble de son code source sont protégés par des droits d'auteur et sont soumis à une licence propriétaire.
Toute utilisation, reproduction, distribution ou modificationdu code, en partie ou en totalité, sans l'autorisatinexpresse de l'auteur est strictement interdite.
Pour toute demande de licence ou pour obtenir des droits d'utilisation, veuillez contacter l'auteur directement.

## Contact
contact@mawqi3creation.com
