# Rapport étude de menaces

## Introduction



## Décrire le système 

### Data Flow Diagram

### Identifier ses biens 

Dans le monde d'aujourd'hui, une chose qui prend beaucoup de valeur, c'est les données. Dans une application comme celle-ci, qui pourrait gérer quelques dizaine d'utilisateurs. Si leurs données venaient à se faire voler, cela aurait des conséquences directes et indirects sur les développeurs. 

#### Informations de login 

L'un des biens qui est vraiment sensible pour notre application est les données de connexion  des utilisateurs et des administrateurs de l'application. Si un ou des utilisateurs utilisent le même pseudo et mot de passe pour plusieurs applications, ce qui est généralement le cas, cela permettrait à un attaquant de tenter des mouvements latéraux sur d'autres site où l'utilisateur a aussi un compte.

#### Le contenu des messages

Les messages peuvent être de nature assez sensible. Si on prend le contexte de l'application dans une entreprise, cela peut vite devenir délicat si des messages fuites. Des données sensibles sur des clients, l'infrastructure peut compromettre la réputation des services de l'entreprise voire même, occasionner des pertes financière. 

### Définir le périmètre de sécurisation

Le périmètre de l'application est destiné à évolué dans contexte clos coupé de l'interaction d'internet. Cela vient principalement de la fonctionnalité assez simple de l'application qui permet à des employés de pouvoir discuter entre eux. Le fait que l'application ne soit pas en contact direct avec le `monde réel` réduis la probabilité d'attaque. 

## Sources de menaces

- Hackers
  - Motivation: gloire, financière, usage d'information pour mouvement latéraux
  - Cible: Tous les éléments actifs permettant d'accéder et de gérer l'application
  - Potentialité: Basse



- Employé mécontent
  - Motivation: revanche, financière
  - Cible: tous éléments pouvant nuire à l'entreprise
  - Potentialité: Haute



- Concurrent
  - Motivation: Vol de secret professionnel dans les messages des employés
  - Cible: base de données des messages via un employé mécontent
  - Potentialité: Moyenne

## Identifier les scénarios d'attaques



### Éléments du système attaqué

### Motivation

### Scénario d'attaque

### STRIDE

| Composant de l'aplication | spoofing | Tampering | Repudiation | Information disclosure | Dos  | Elevation of privileges |
| ------------------------- | -------- | --------- | ----------- | ---------------------- | ---- | ----------------------- |
| Data Store                |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |
|                           |          |           |             |                        |      |                         |



## Identifier les contre-mesures

### PhpLiteAdmin

Nous avons ajouté un correctif avec la version de phpLiteAdmin 1.9.8.2 qui est la dernière version sortie. Nous avons aussi changer le mot de passe par défaut en **P@ssw0rd**. 

### PHP Version et nginx 

Nous avons remplacé la version de php par la version 7.4.13 qui ne souffre pour l'instant d'aucune vulnérabilité. Nous avons aussi profité de faire la mise à jour du serveur nginx même si la version ne souffrait d'aucune vulnérabilité connue.

## conclusion
