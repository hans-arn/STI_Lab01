<?php
include "config.php";

if(isset($_POST['but_submit'])){
    $uname = $_POST['txt_uname'];
    $password = $_POST['txt_pwd'];

    if ($uname != "" && $password != ""){
        if(isset($file_db)){
            //print_r("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
             //$result =$file_db->query("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
            $row =$file_db->query("select username,isAdmin FROM userSti where username like '$uname' and password like '$password' and isActive=1");
            $row = $row->fetch();
            if(isset($row['username'])){
                print $row['username'] . "\t";
                print  $row['isAdmin'] . "\t";
            }else
                echo "retry";

        }


    }

}
?>

<link rel="stylesheet" href="style.css" />
<div class="container">
    <form method="post" action="">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
        </div>
    </form>
</div>





<?php
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = $_POST['txt_uname'];
    $password = $_POST['txt_pwd'];

    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
        }else{
            echo "Invalid username and password";
        }

    }

}
