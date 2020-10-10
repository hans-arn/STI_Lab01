
<?php
include 'config.php';
include 'headerAdmin.php';


$userID = $_GET['id'];
$delAccount = $_GET['delete'];

if(isset($file_db)){

    $sql_req = "select username from userSti where $userID = id";
    $username = $file_db->query($sql_req);
    $username = $username->fetch();
    $username = $username['username'];

    if(isset($delAccount)){
        if($file_db->exec("delete from userSti where id = $delAccount")){
            header("Location: adminPage.php");
        }
    }

    if(isset($_POST['but_password'])){
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

    if(isset($_POST['but_active'])){
        $answer = $_POST['terms'];
        if(!strcmp($answer, "yes")){
            $file_db->exec("update userSti set isActive = 1 where id = $userID");
        }else if(!strcmp($answer, 'no')){
            $file_db->exec("update userSti set isActive = 0 where id = $userID");

        }

    }

    //    check if the account is active
    $isActive = $file_db->query("select isActive from userSti where $userID = id");
    $isActive = $isActive->fetch();
    $isActive = $isActive['isActive'];

}





?>

<h1>Updating <?php echo $username?> profile</h1>

<!--Reseting password-->
Reset password
<form method="post" action="">
    <div>
        <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/>
    </div>

    <div>
        <input type="submit" value="Reset" name="but_password" id="but_password" />
    </div>
</form>

<?php
if($reset_success){
    echo "Password updated";
}
?>

<!--Desactivate account-->
<form action="" method="post">
    Active :
    <?php if($isActive){?>
        <label>
            <input type="radio" name="terms" value="yes" checked="checked"> Yes
        </label>
        <label>
            <input type="radio" name="terms" value="no"> No
        </label>
    <?php } else{ ?>
        <label>
            <input type="radio" name="terms" value="yes"> Yes
        </label>
        <label>
            <input type="radio" name="terms" value="no" checked="checked"> No
        </label>
    <?php } ?>
    <input type="submit" name="but_active" value="Submit">
</form>

<!--Deleting account-->
</br>
<a href="adminCheckUser.php?id=<?php echo $userID?>&delete=<?php echo $userID?>"> Delete account </a>

<?php
if($delAccount){
    echo "Account deleted";
}
?>




