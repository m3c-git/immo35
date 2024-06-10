# immo35
MODOP déploiement du projet IMMO35:

1 Cloner le dépôt du projet https://github.com/m3c-git/immo35.git <!-- Demander le droits d'accès au repo avant, si besoin -->
2 Récupérer à partir du dépot le fichier ".env", le fichier "composer.lock" et le répertoire "vendor"
3 Récupérer l'export de la bdd "eddyfrair_immo35_db_deploiement.sql" présent dans le repo.
4 Importer la sauvegarde de la BDD dans la nouvelle basse qui recevra le projet.
5 Mettre à jour les informations du fichier .env avec les informations de la nouvelle base de données.
6 Lancer la commande "composer update" pour mettre à jour les dépendences.
7 Lancer la commande "composer dump-autoload" pour mettre à jour l'autoload.
8 Adapter les liens pour correspondre avec le dommaine qui correspondra au projet en ligne.
9 Verifier si les chemin des des fichiers image sont correct. Adapter au nouvel environnement si besoin. 
10 A l'aide de filezilla ou web ftp de l'hébergueur utilisé, copier les sources du projet sur l'hébergement en ligne (server dédié ou personnalisé).
11 Vérifier si les points 4, 5 et 6 ont bien été réalisés.
11 Tester l'accès au site et corriger les différents bug qui pourrait être lié à la mise en ligne du projet.
