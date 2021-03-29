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

## Options
Les paramètres de route peuvent être facultatif : il suffit de leur mettre une valeur par défaut
dans la méthode de controller.

On peut forcer des paramètres un respecter un format grâce une expression régulière, définie
dans la section "requirements" de la route.

Facultatif et format peuvent être définis directement dans le paramètre de route entre accolade.

## ParamConverter
Le composant ParamConverter permet de convertir des paramètres d'URL en objet.
Il faut juste typer dans la méthode du controller l'objet souhaité, et l'instance sera injecté automatiquement.

Exemple :
url : /produit/{id}
signature : function show(Produit $produit)
La variable $produit sera automatiquement setté avec l'objet dont l'id a pour valeur le paramètre id
Le nom du paramètre doit correspondre au nom de la propriété de l'objet.

# 3 Templates
Le moteur de template par défaut de Symfony est Twig.
Cela sert à générer une vue grâce à un template.

Raccourci depuis un controller SF :
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

Faire un lien vers un controller
- path('route_name')

Afficher une propriété d'un objet, si on fait objet.propriete :
- si objet est de type tableau, et si propriete est une clé valide : $objet['propriete']
- si objet est de type objet, vérifie si propriete est une attribut valide (existe et est public) : $object->propriete
- vérifie si propriete est une méthode valide : $object->propriete()
- vérifie si le getter de cette propriete est valide : $object->getPropriete()
- vérifie si les getters isPropriete / hasPropriete est valide
- vérifie si __call est définie
- sinon plante

Messages flash :
Les messages flash sont des messages destinées à n'être affiché qu'une seule fois :
par exemple après la validation d'un formulaire pour indiquer à l'utilisateur
si ça s'est pas bien ou pas. Les messages sont mis en réalité mis en session,
et supprimé de la session dès lors qu'ils sont affichés en twig.

- include
Inclure un template dans un autre
  
- render
Appeler un controller depuis un template
  
- Ajouter un message flash 
``
  $this->addFlash('type', 'message');
``
  
- Afficher : On obtient les messages depuis la variable app en twig.
``
    {% for key, messages in app.flashes %}
        {% for message in messages %}
            <div class="alert alert-{{ key }}" role="alert">
                {{ message }}
            </div>
        {% endfor %}
    {% endfor %}
``

Variable global App :

# 4 Entités
Les entités représentent les données métier que l'on veut persister.
Par exemple, site e-commerce : compte client, produits et leur catégorie, commandes

## Création / Structure
```
- 1) Configurer les accès de la BDD dans le fichier .env
- 2) Créer la base : php bin/console doctrine:database:create
- 3) Créer l'entité : php bin/console make:entity
- 4) Mettre à jour la base : 
    - soit avec les migrations (bonne pratique)
        - php bin/console make:migration
        - php bin/console doctrine:migrations:migrate
    - ou directement avec doctrine:schema:update
```

On peut également créer des entités à partir d'une base de de données existante :
https://symfony.com/doc/current/doctrine/reverse_engineering.html

## Utilisation CRUD
### READ
Dans un controller, ou dans un service, on a besoin du manager de Doctrine.
Grâce on va pouvoir récupérer les repository (qui sont les objets de récupération d'entité), avec par défaut :
findAll, find, findBy, findOneBy

On pourra créer nos requêtes personnalisées.

### CREATE / UPDATE / DELETE
On récupère le manager de doctrine, qui gère les entités grâce aux méthodes : persist(), remove(), flush()
Par défaut doctrine utilise les transactions.

### Relations entre entités
ManyToOne / OneToMany
ManyToMany / ManyToMany
OneToOne 

# 5 - Formulaires
## Association avec entité

Pour hydrater les entités dans symfony, on va utiliser le composant Form, au lieu
de faire un formulaire en html, puis de récupérer les valeurs une par une,
puis de valider les valeurs.

- On crée un formulaire associé à une entité : ``make:form``
- Dans le controller :
    - on instancie l'objet
    - on crée le formulaire et on lui associe l'instance
    - on checke si le formulaire est soumis et valide
        - si oui on enregistre en bdd av
          ec doctrine
    - sinon on affiche le formulaire dans le template avec les fonctions
        - form() : le formulaire en une seule fois
        - form_row() : champs par champs
        - form_widget(), form_label(), form_errors(), form_help() : élément de champ par élément
    
On peut créer des thèmes de formulaires :
https://symfony.com/doc/current/form/form_themes.html

## Validation
On valide ses entités grâce au composant Validator. Le composant Form utilise 
automatiquement les validations. On configure les validations :
- soit dans l'entité avec annotations/attributs
- soit différent dans la classe FormType
https://symfony.com/doc/current/reference/constraints.html

On peut créer notre propre contrainte si on ne trouve pas parmi l'existant :
https://symfony.com/doc/current/validation/custom_constraint.html

## Options des formulaires
On peut configurer les champs des formulaires :
- type de champs html
- label, mapped, attr (attributs html)
- validation : constraints

## Générer un crud :
A partir d'une entité existante, on peut générer un crud entier avec 
- controller
- formulaire
- templates

`` php bin/consoke make:crud ``

## Relations entre les entités dans les formulaires 
- manyToOne:
    - association à une entité existante en BDD
    - création une entité : formulaire imbriqué
    
- oneToMany / manyToMany
    - association à des entités existantes en BDD
    - création de collection d'entité : formulaires imbriqués (javascript)
    

## 6 - Services
Un service est une classe d'objet qui va offrir une fonctionnalité particulière.
On découpe nos classes le mieux possible en respectant le principe de responsabilité unique.

Symfony nous propose son container de service.

- Créer d'un service
- Charger dans le container
- Utilisation du service :
    - Container instancie le service pour nous
    - Il nous le retourne
    - La fois suivante le service est instancié, le container nous le retourne directement
    
Le container de service gère les dépendances (injection de dépendances) :
quand un service a besoin d'un autre service pour fonctionner, on va laisser le container
l'injecter automatiquement. C'est le typage de la variable qui indique au container quel service est demandé.

On peut par défaut injecter n'importe quel service :
- dans toutes les méthodes des controllers
- dans le constructeur d'autres services

[Fonctionnement en image](https://zestedesavoir.com/media/galleries/500/1ae0ce0d-a264-4bfb-b3c6-37225d8f4e52.png)

Exercice :
- Une page qui affiche un topic grâce à son slug récupéré de l'URL
- Dans cette page, ajouter un formulaire qui permet d'ajouter un message dans ce topic

- Ajouter une fonctionnalité qui permet d'ajouter un point à un message.
- Au sein d'un topic, afficher les messages triés par point : ceux qui le plus de point sont en premier.
- S'assurer que le premier message (l'original) est toujours placé en premier même si ce n'est pas celui qui a le plus de point

- Ajouter un système qui permet de rajouter des commentaires sur des messages 
  
- Faite une page d'accueil qui affiche les trois topics dont l'activité est la plus récente
  (le fait qu'un message/commentaire ait été posté dedans)

## 7 - Security
Les sessions utilisateurs et l'authentification sont en grande partie gérées par le composant
Security.

Ce composant se configure dans config/packages/security.yaml.
La première chose à faire serait d'indiquer une expression régulière pour protéger un ensemble de page.

On ne vérifiera jamais si un utilisateur est connecté dans un controller dans le but de rediriger
vers un formulaire de login, on laissera le composant le faire pour nous.

Il y a plusieurs méthodes d'authentification possibles. La plus courante serait de créer un formulaire
de login qui regarde en base si le user existe et si son mot de passe est bon.

On peut se faciliter la tâche à nouveau avec les commandes :
`` 
symfony console make:user
symfony console make:auth
``

### Protéger des pages avec les rôles
On peut déterminer les rôles requis pour un ensemble de page dans la config "access_control".

### Accéder à l'utilisateur connecté
#### Dans un controller :
``$this->getUser()``

#### Dans un template
``{{ app.user }}``

### Vérifier les rôles de l'utilisateur connecté
#### Dans un controller
``$this->isGranted("ROLE")``

#### Dans un template
``{% if is_granted("ROLE") %}``

### Voters
Les voters permettent de vérifier des régles métier sur les entités.
On définit toutes les actions possibles sur une entité, et on spécifie dans un voter
dans quelles circonstances un user connecté peut exécuter cette action.

On utilise les voters pour éviter d'écrire ces régles dans les controllers.

Dans les controllers, on utilise juste :
``$this->denyAccessUnlessGranted(action, entity)``

Un voter ne doit se déclencher que pour un seul type d'entité, mais on peut plusieurs voters
pour un même type d'entité.
On peut alors appliquer une stratégie de décision d'accès :
Autoriser si un seul voter dit oui, si la majorité dit oui, si tout le monde dit oui, ou par priorité :
https://symfony.com/doc/current/security/voters.html#changing-the-access-decision-strategy

## 8 - Listener / Subscriber
Système d'évenements / écouteurs

Evenement Symfony

Evenement Doctrine

Listener entity :
- Dans l'entité : HasLifeCycleCallbacks
- Dans une classe listener pour toutes les entités
- Dans une classe listener pour une entité