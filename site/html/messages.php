<?php
    include "header.php";

    if(isset($file_db)){
        if(isset($_GET["del"]))
            $file_db->exec("DELETE FROM message WHERE id=".$_GET['del']);
    if(isset($_SESSION["username"])){
    $sql = "select message.id as id,receiptDate,sujet,username,sender FROM message INNER JOIN userSti ON userSti.id = message.receiver WHERE userSti.username='".$_SESSION['username']."' ORDER BY receiptDate desc";

    $result =$file_db->query($sql);

?>
<table style="width:100%">
    <tr>
    <th>Date de reception</th>
    <th>sujet</th>
    <th>expediteur</th>
        <th>actions</th>
    </tr>
<?php
foreach  ($file_db->query($sql) as $row) {

?>

<tr>

<td>
    <?php echo $row['receiptDate']?>
</td>
<td>
    <?php echo $row['sujet']?>
</td>
<td>
    <?php $sql = "SELECT username FROM userSti WHERE id=". $row['sender'];
    $user =$file_db->query($sql)->fetch();
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
    }
   }
}
?>
</table>

