
<?php
include 'config.php';
include 'headerAdmin.php';


$userID = $_GET['id'];
$delAccount = $_GET['delete'];

echo $delAccount;
if(isset($file_db)){
    echo 'a';
    $sql_req = "select username from userSti where $userID = id";
    echo 'b';
    $username = $file_db->query($sql_req);
    echo 'c';
    $username = $username->fetch();
    echo 'd';
    $username = $username['username'];

    echo $delAccount;
    if(isset($delAccount)){
        echo "yoyoyo";
        if($file_db->exec("delete from userSti where id = $delAccount")){
            $del_success = 1;
        }
    }
}

if(isset($_POST['but_submit'])){
    $uname = $_POST['txt_uname'];
    $password = $_POST['txt_pwd'];

    if ($password != ""){
        if(isset($file_db)){
            $reset_success = 0;
            if($file_db->exec("update userSti set password = '$password' where id = $userID")){
                $reset_success = 1;
            }

        }


    }
}




?>

<h1>Check <?php echo $username?> profile</h1>

<p> Reset password </p>
<form method="post" action="">
    <div>
        <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/>
    </div>

    <div>
        <input type="submit" value="Reset" name="but_submit" id="but_submit" />
    </div>
</form>

<?php
if($reset_success){
    echo "Password updated";
}
?>

</br>
<a href="adminCheckUser.php?id=<?php echo $userID?>&delete=<?php echo $userID?>"> Delete account </a>

<?php
if($delAccount){
    echo "Account deleted";
}
?>


