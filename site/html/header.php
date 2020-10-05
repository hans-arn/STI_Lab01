<?php
include "config.php";
if(isset($_SESSION["username"])){
    echo $_SESSION["username"];
}
else{
    header('Location: login.php');
    exit();
}
?>

<ul>
    <li><a href="messages.php">messages</a></li>
    <li><a href="news.asp">News</a></li>
    <li><a href="contact.asp">Contact</a></li>
    <li><a href="about.asp">About</a></li>
    <?php
    if(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==1 ){?>
        <li><a href="adminPage.php">admin</a></li>
    <?php
    }
    if (isset($_SESSION['username'])){
    ?>
        <li><a href="login.php?logout">logout</a></li>
    <?php }?>
</ul>