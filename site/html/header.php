<?php
include "config.php";
//if the user is not connect redirect to the login page
if(!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
} ?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>BreakMyMail</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/tab.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="messages.php">Messages</a></li>
            //add an access to the admin page is the user is an admin
            <?php if(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==1 ){?>
                <li class="nav-item"><a class="nav-link"href="adminPage.php">Admin</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">BreakMyMail</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <span class="navbar-text" href="#">Signed in as : <?php echo $_SESSION["username"];?></span>
            <li class="nav-item">
                <?php if (isset($_SESSION['username'])){?>
                    <li class="nav-item"><a class="nav-link" href="login.php?logout">- Logout</a></li>
                <?php }?>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>
