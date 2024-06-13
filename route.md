#Liste des routes:

##Route vers la page de connexion
index.php?route=login

##Route vers la page de vérification de connexion
index.php?route=check-login

##Route vers la page de déconnexion
index.php?route=logout

##Route vers la page d'accueil
index.php

##Route vers la page des biens à louer
index.php?route=rent

##Route vers la page détaillée d'un bien à louer
index.php?route=details-property&id={id}

##Route vers la page des biens à acheter
index.php?route=buy

##Route vers la page détaillée d'un bien à acheter
index.php?route=details-property&id={id}

##Route vers la page du formulaire pour vendre ou faire estimer un bien
index.php?route=sell

##Route vers la page de vérification d'envoie d'un formulaire pour demande de vente ou d'estimation d'un bien
index.php?route=check-contact

##Route vers la page du formulaire pour gérer un bien
index.php?route=contact-manage

##Route vers la page de vérification d'envoi d'un formulaire pour demande de gestion d'un bien
index.php?route=check-contact-manage

##Route vers la page du formulaire de contact
index.php?route=contact

##Route vers la page de vérification d'envoi du formulaire de contact
index.php?route=check-contact

##Route vers la page des mentions légales
index.php?route=legal-information 

##Route vers la page de la politique de confidentialité
index.php?route=privacy-policy

##Route vers la page de la politique des cookies
index.php?route=cookies-policy

##Route vers la page d'administrations des biens et des utilisateurs
index.php?route=admin

##Route vers la page d'administrations pour la gestion des biens
index.php?route=admin-property-type

##Route vers la page d'administrations pour la liste des biens par type
index.php?route=admin-property-by-type&type={{type.typeName}}&typeMedia=vignette

##Route vers la page d'administrations pour l'ajout d'un bien
index.php?route=add-property

##Route vers la page de vérification d'ajout d'un bien 
index.php?route=check-add-property

##Route vers la page d'administrations pour mettre à jour un bien 
index.php?route=update-property&id={id}&type=Appartements

##Route vers la page de vérification de mise à jour d'un bien 
index.php?route=check-update-property

##Route vers la page d'administrations pour supprimer un bien
index.php?route=delete-property&id={{ property.property.id }}&type={{ property.property.type.typeName }}&typeMedia=vignette

##Route vers la page de vérification de la suppression d'un bien 
index.php?route=check-delete-property&type={{ propertyById.type.typeName }}

##Route vers la page d'administrations pour la gestion des utilisateurs
index.php?route=admin-users-role

##Route vers la page d'administrations pour la liste des utilisateurs avec le rôle propriétaire
index.php?route=users-proprietaire&role=proprietaire

##Route vers la page d'administrations pour la liste des utilisateurs avec le rôle locataire
index.php?route=users-locataire&role=locataire

##Route vers la page d'administrations pour la liste des utilisateurs avec le rôle reader
index.php?route=users-admin&role=reader

##Route vers la page d'administrations pour la liste des utilisateurs avec le rôle admin
index.php?route=users-admin&role=admin

##Route vers la page d'administrations pour l'ajout d'un administrateur
index.php?route=register

##Route vers la page de vérification d'ajout d'un administrateur
index.php?route=check-register

##Route vers la page d'administrations pour mettre à jour un administrateur
index.php?route=update-admin&id={id}

##Route vers la page de vérification de mise à jour d'un administrateur
index.php?route=check-update-admin

##Route vers la page d'administrations pour l'ajout d'un utilisateur
index.php?route=add-user

##Route vers la page de vérification d'ajout d'un utilisateur
index.php?route=check-add-user

##Route vers la page d'administrations pour mettre à jour un utilisateur
index.php?route=update-user&id={id}

##Route vers la page de vérification de mise à jour d'un utilisateur
index.php?route=check-update-user

##Route vers la page de vérification de la suppression d'un utilisateur
index.php?route=delete-user&id={id}