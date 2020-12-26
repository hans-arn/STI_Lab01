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
        $sql = "select  id,receiptDate,sujet,receiver,sender,messageBody FROM message WHERE id = ".$_GET['id'];
        $result = $file_db->query($sql);
        $result=$result->fetch();
        //get the receiver username to check if the message was for him
        $sql = "SELECT username as receiver FROM userSti WHERE id=".$result['receiver'];
        $toCheck = $file_db->query($sql);
        $toCheck=$toCheck->fetch();
        if($toCheck['receiver']!=$_SESSION['username'])
            header('Location: messages.php');

        $sql = "SELECT username as sender FROM userSti WHERE id=".$result['sender'];
        $sender = $file_db->query($sql);
        $sender=$sender->fetch();

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
