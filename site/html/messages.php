<?php
include "header.php";
    if(isset($file_db)){
        // if a del param in the get method is detected remove the message
        if(isset($_GET["del"])&&$_GET["del"]!=""){
            $deleteQuery =$file_db->prepare("DELETE FROM message WHERE id= ?");
            $deleteQuery->execute([$_GET['del']]);
        }
?>
<div class="row justify-content-center">
<div class="col-9 " >
<a href="contact.php">Envoyer un message</a>
<?php
            //check if the user has messages
            $someMessageQuery = $file_db->query( "select 1 FROM message INNER JOIN userSti ON userSti.id = message.receiver WHERE userSti.username=?");
            $someMessageQuery->execute([$_SESSION['username']]);
            $areSomeMessage = $someMessageQuery->fetchColumn();
            if($areSomeMessage){
                //select all messages
                $sql = "select message.id as id,receiptDate,sujet,username,sender FROM message INNER JOIN userSti ON userSti.id = message.receiver WHERE userSti.username= ? ORDER BY receiptDate desc";
                $result=$file_db->prepare($sql);
                $result->execute([$_SESSION['username']]);
?>

<table class="table table-striped table-bordered"  >
    <tr>
    <th scope="col">Date de reception</th>
    <th scope="col">sujet</th>
    <th scope="col">expediteur</th>
        <th>actions</th>
    </tr>
<?php
                $rows = $result->fetchAll();
                //print all message
                foreach  ($rows as $row) {
?>

<tr scope="row">

<td>
    <?php echo $row['receiptDate']?>
</td>
<td>
    <?php echo $row['sujet']?>
</td>
<td>
    <?php

    $sql = "SELECT username FROM userSti WHERE id= ? ";
    $userQuery = $file_db->prepare($sql);
    $userQuery->execute([$row['sender']]);
    $user=$userQuery->fetch();
    if(isset($user['username']))
        echo $user['username'];
    else
        echo "compte supprime";
            ?>
</td>
    <td>
        <ul>
            <li> <a href="messages.php?del=<?php echo $row['id']?>">Supprimer</a></li>
            <li> <a href="message.php?id=<?php echo $row['id']?>">Ouvrir</a></li>
            <li> <a href="writeMessage.php?id=<?php echo $row['sender']?>">Repondre</a></li>
        </ul>
    </td>

</tr>
<?php
                }//foreach
            }//someRow
            else {?>
            <p>Vous n avez aucun message</p>
            <?php }
    }//db connector
?>
</table>
</div>
</div>
