# auth

## login

select username,isAdmin FROM userSti where $username like username and $password = password and isActive=1

## ## change password

UPDATE userSti SET password = $password

WHERE id = $userid

# message

## liste les messages correspondant a 1 mec

select id,receiptDate,sender,sujet FROM message where $user like receiver ORDER BY receiptDate desc

## affiche le contenu du message

select id,receiptDate,sender,sujet,bodyMessage FROM message where $id = id 

# user

// check php si admin ( session_php)

//ajout utilisateur

INSERT INTO userSti (username,password,isAdmin,isActive) VALUES ($username,$password,0,1)

//liste tous les users

SELECT id,username FROM userSti

//liste 1 user

SELECT id,username,password,isActive FROM userSti WHERE id = $id

//met a jour password et validité du compte

UPDATE userSti SET password=$password,isActive=$active WHERE id =$id

//delete user 

DELETE FROM userSti

WHERE id =$id

