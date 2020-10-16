## BreakMyMail - Web Mail Application 

Auteur : Gaëtan Daubresse, Quentin Saucy 

### Installation  

Pour déployer l'application web, exécutez le script [deploy-website.sh](./deploy-website.sh) 

```bash
#!/bin/bash 

docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_lab01_daubresse_saucy --hostname sti arubinst/sti:project2018

docker exec -u root sti_lab01_daubresse_saucy service nginx start

docker exec -u root sti_lab01_daubresse_saucy service php5-fpm start
```

Pour supprimer le container, exécutez le script [delete-container.sh](./delete-container.sh)

```bash
#!/bin/bash 

docker stop sti_lab01_daubresse_saucy

docker rm sti_lab01_daubresse_saucy
```

### Utilisation 

##### Login 

La page de login peut être atteinte à l'adresse suivante : http://localhost:8080/login.php 

| Username | Password | admin |
| -------- | -------- | ----- |
| admin    | admin    | oui   |
| alice    | alice    | non   |
| bob      |          | non   |

<img src="image/image-20201015114011314.png" alt="image-20201015114011314" style="zoom:67%;" />



##### Admin page 

La page admin permet de lister tous les utilisateurs enregistrés dans la base de donnée. 

Il est également possible de créer un nouveau compte utilisateur en cliquant sur le bouton `Add new account`



<img src="image/image-20201016172102977.png" alt="image-20201016172102977" style="zoom:67%;" />

##### Envois message 

Pour envoyer un message cliquer sur le lien `envoyer un message`. 

Il est ensuite possible de sélectionner un utilisateur dans la liste ou de rechercher directement le user  



<img src="image/image-20201016172153096.png" alt="image-20201016172153096" style="zoom:67%;" />

