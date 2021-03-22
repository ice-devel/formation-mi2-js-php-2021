# Symfony

## 1 - Présentation

A l'origine : Fabien Potencier
Entreprise : SensioLabs

Symfony est un framework : CADRE DE TRAVAIL
- Façon de structurer son code imposée
- Des composants stand-alone : on peut les utiliser dans tout projet PHP. Des fonctionnaltiés avancées
qu'on ne va pas réinventer. Testées et éprouvées par toute la communauté.
- Basé sur du MVC
- Concurrents : Zend Framework, Laravel, CakePHP

Un framework se différencie des CMS (Content Manager System) comme Wordpress, Joomla, Drupal, Prestashop.
où l'on n'a pas besoin de savoir coder pour créer des sites, même si on peut modifier selon
certaines pratiques ces CMS.

Avantages d'un framework : développement plus rapide / composants avancées / + dé sécurité /
maintenance et évolution plus aisée

Inconvénient : Courbe d'apprentissage

Symfony 1 : 2005-2008 SensioFramework devient Symfony - Gestion utilisateurs
Sf2 2012 : Changement structure / Apparition des bundles
Sf3 2015 : Nouveaux composants
Sf4 2018 : Changement architecture dossier
Sf5 2021 : Nouveaux composants


## 2 - Installation
Pré-requis
- Serveur web, serveur bdd, et PHP
- Composer : gestionnaire de dépendance
- Symfony installer : https://symfony.com/download
- Variables d'environnement : php, composer, symfony

Pour le serveur web :
- On peut utiliser le serveur built-in symfony : symfony server
- On peut utiliser son serveur web commme apache (création du vhost, du faux domaine, etc.)

## 3 - Architecture
- bin : console pour faire les commandes
- config : tous les fichiers yaml pour configurer les composants
- public : le dossier accessible par les navigateurs donc on y trouve le front controller
- src : notre code source
- var : ce qui évolue pendant la vie de l'app : cache, logs
- vendor : bibliothèque externe gérées avec composer
- templates : 
- translations :
- tests : tests unitaires / fonctionnels
- migrations : différentes étapes de la création/modification de la bdd

## 4 - Utilisation
On veut créer une page :
- controller
- route
- template

# 1 Controller
Le point d'entrée de la page (après le controller frontal).

On définit une route pour avoir un controller (callable : que le routeur peut appeler).
Les routes sont définies avec les attributs PHP 8 de préférence, ou les annotations
avant PHP 8. L'attribut Route doit être placé juste avant le controller qui doit être 
appelé.

Le controller doit retourner un objet de type Response (namespace Symfony\Component\HttpFoundation)

# 2 Routing
Le controller est appelé par le routeur si le pattern de la route matche.

Les pattern peuvent être dynamiques : on peut y insérer des paramètres, dont les valeurs
récupérées seront injectées dans les méthodes de controller.
exemple :
- /user/update/{id}
- public function methodName($id)

Les paramètres de route peuvent être facultatif : il suffit de leur mettre une valeur par défaut
dans la méthode de controller.

On peut forcer des paramètres un respecter un format grâce une expression régulière, définie
dans la section "requirements" de la route.

Facultatif et format peuvent être définis directement dans le paramètre de route entre accolade.

# 3 Templates
Le moteur de template par défaut de Symfony est Twig.
Cela sert à générer une vue grâce à un template.

Raccourci depuis un controlelr SF :
- $this->render()
- premier param : le fichier template
- deuxième : tableau associatif des valeurs que l'on veut au template

Dans un template, on peut
- Ecrire un commentaire : {# #}
- Faire quelque-chose : Tester une condition / Boucler : {% %}
- Afficher : {{ }}

On peut également :
- hériter d'un template avec le mot-clé extends : reprendre le contenu du template
parent et modifier uniquement certaines parties : les blocks.
- On peut rédéfinir les blocks dans l'ordre que l'on souhaite
- On peut reprendre le contenu du block parent pour y ajouter quelque-chose

Inclure des assets (css, js, images...):
- asset("chemin/fichier/depuis/public")

Afficher une propriété d'un objet, si on fait objet.propriete :
- 
- 
-
-

# 4 Entités

https://symfony.com/doc/current/doctrine/reverse_engineering.html