<?php
//print a message
include "header.php";
//if the message id is not set redirect to the messages page
if (!isset($_GET['id'])){
    header('Location: messages.php');
    exit();
}
if(isset($file_db)){
        // get value from the message
        $query=$file_db->prepare( "select  id,receiptDate,sujet,receiver,sender,messageBody FROM message WHERE id = ?");
        $query->execute(array($_GET['id']));
        $result = $query->fetch();
        //get the receiver username to check if the message was for him
        $receiverQuery =$file_db->prepare( "SELECT username as receiver FROM userSti WHERE id=?");
        $receiverQuery->execute(array($result['receiver']));
        $toCheck=$receiverQuery->fetch();
        if($toCheck['receiver']!=$_SESSION['username']){
            header('Location: messages.php');
            exit();
        }
        $senderQuery =$file_db->prepare( "SELECT username as receiver FROM userSti WHERE id=?");
        $senderQuery->execute(array($result['sender']));
        $sender=$senderQuery->fetch();

    }
        ?>
        <div class="row justify-content-center">
        <div class="col-9 " align=center>
    <p class="lead"> Expediteur : <?php echo $sender['sender']?></p>
    <p> Le : <?php echo $result['receiptDate']?></p>
    <p> Sujet : <?php echo $result['sujet']?></p>
    <p> Message : <?php echo $result['messageBody']?></p>
<ul class="list-group col-4 justify-content-center">
    <li class="list-group-item "> <a href="messages.php?del=<?php echo $result['id']?>">Supprimer</a></li>
    <li class="list-group-item " > <a href="writeMessage.php?id=<?php echo $result['sender']?>">Repondre</a></li>
</ul>
</div>
</div>
