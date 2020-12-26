<?php
include "config.php";
if(isset($_GET['logout']))
    session_destroy();

//login info taken into variables and password hashed in md5
if(isset($_SESSION["username"]))
    header('Location: messages.php');

if(isset($_POST['but_submit'])){
    $sanitized_c = filter_var($_POST['txt_uname'], FILTER_SANITIZE_STRING);
    $password = hash('md5', $_POST['txt_pwd']);
//connection if username and password are correct
    if (!empty($sanitized_c) && !empty($password)){
        if(isset($file_db)){
                $row =$file_db->query("select id,username,isAdmin FROM userSti where username like '$sanitized_c' and password like '$password' and isActive=1");
                $row = $row->fetch();
                if(isset($row['username'])){
                $_SESSION["username"]=$row['username'];
                $_SESSION["id"]=$row['id'];
                $_SESSION["isadmin"]=1;
                header('Location: messages.php');
            }
        }
    }
}
?>
<link href="css/signin.css" rel="stylesheet">
<div class="container">
    <h1 class="h1 mb-1 font-weight-normal" align="center">BreakMyMail</h1>
    <form method="post" action="" class="form-signin">
        <div id="div_login">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <div>
                <input type="text" class="form-control" id="txt_uname" name="txt_uname" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="form-control" id="txt_uname" name="txt_pwd" placeholder="Password"/>
            </div>
            <div>
<!--                <button class="btn btn-lg btn-primary btn-block" type="but_submit">Sign in</button>-->

                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in" name="but_submit" id="but_submit" />
            </div>
        </div>
    </form>
</div>
