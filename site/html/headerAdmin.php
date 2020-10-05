<?php
include "header.php";

if(!(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==1)){
    header('Location: messages.php');
}
