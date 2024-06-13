# immo35

Immo35 est un site internet pour les agents immobilier indépendant, leur permet de gérer de façon simple biens qu'ils peuvent avoir en location, en vente.  

## Fonctionnalités
- Ajout, modification, et suppression des biens
- Ajout, modification, et suppression des propriétaire et locataires 
- Ajout, modification, et suppression des Administrateur du site
- Authentification pour les adminstrateur
- Possibilités de filtrage des biens pour les visiteurs, par status (a vendre, à louer), par types (maisson, appartement...) et localisation
- Formumaire de contact
- Accès rapide au biens à louer ou à vendre

## Technologies utilisées
Front-end : HTML + TWIG pour le balisage et la mise en place des template de page, JavaScript pour le intéractions, SASS pour le style et les animations, Bootstrap pour le style, l'éditeur WISIWYG TinyMCE, JQuery pour carousel
API : PHP avec le framework Laravel, MySQL pour la base de données



## Installation et Configuration
**Prérequis** 
PHP, Composer, TWIG, SASS, TinyMCE, JQuery, Filezilla

**Installation**
1 Cloner le dépôt du projet https://github.com/m3c-git/immo35.git <!-- Demander le droits d'accès au repo avant, si besoin -->
2 Récupérer à partir du dépot le fichier ".env", le fichier "composer.lock" et le répertoire "vendor"
3 Récupérer l'export de la bdd "eddyfrair_immo35_db_deploiement.sql" présent dans le repo.
4 Importer la sauvegarde de la BDD dans la nouvelle basse qui recevra le projet.
5 Mettre à jour les informations du fichier .env avec les informations de la nouvelle base de données.
6 Lancer la commande ```bash composer update ``` pour mettre à jour les dépendences.
7 Lancer la commande ```bash composer dump-autoload `` pour mettre à jour l'autoload.
8 Adapter les liens pour correspondre avec le dommaine qui correspondra au projet en ligne.
9 Verifier si les chemin des des fichiers image sont correct. Adapter au nouvel environnement si besoin. 
10 A l'aide de Filezilla ou web ftp de l'hébergueur utilisé, copier les sources du projet sur l'hébergement en ligne (server dédié ou personnalisé).
11 Vérifier si les points 4, 5 et 6 ont bien été réalisés.
11 Tester l'accès au site et corriger les différents bug qui pourrait être lié à la mise en ligne du projet.

## Licence
Ce projet et l'ensemble de son code source sont protégés par des droits d'auteur et sont soumis à une licence propriétaire.
Toute utilisation, reproduction, distribution ou modificationdu code, en partie ou en totalité, sans l'autorisatinexpresse de l'auteur est strictement interdite.
Pour toute demande de licence ou pour obtenir des droits d'utilisation, veuillez contacter l'auteur directement.

## Contact
contact@mawqi3creation.com
