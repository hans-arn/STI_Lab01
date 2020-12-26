<?php
include "header.php";
// Header shown only to admin account
if(!(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==1))
    header('Location: messages.php');

