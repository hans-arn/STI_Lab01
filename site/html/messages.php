<?php
    include "header.php";

    if(isset($file_db)){
    if(isset($_SESSION["username"])){
    $sql = "select message.id,receiptDate,sujet,username,sender FROM message INNER JOIN userSti ON userSti.id = message.receiver WHERE userSti.username='".$_SESSION['username']."' ORDER BY receiptDate desc";

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
    $row =$file_db->query($sql)->fetch();
    if(isset($row['username']))
        echo $row['username'];
    else
        echo "compte supprime";
            ?>
</td>
    <td>

    </td>

</tr>
<?php
    }
   }
}
?>
</table>

