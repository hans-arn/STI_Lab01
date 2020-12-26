<?php
include 'headerAdmin.php';


$userID = $_GET['id'];
$delAccount = $_GET['delete'];

if(isset($file_db)){

    $sql_req = "select username from userSti where $userID = id";
    $username = $file_db->query($sql_req);
    $username = $username->fetch();
    $username = $username['username'];

//    delete account from database
    if(isset($delAccount)){
        if($file_db->exec("delete from userSti where id = $delAccount")){
            header("Location: adminPage.php");
        }
    }
//    change account password in databae
    if(isset($_POST['but_password'])){
        $uname = filter_var($_POST['txt_uname'], FILTER_SANITIZE_STRING);
        $password = $_POST['txt_pwd'];

        if (!empty($password)){
            if(isset($file_db)){
                $reset_success = 0;
                if($file_db->exec("update userSti set password = '$password' where id = $userID"))
                    $reset_success = 1;
            }
        }
    }
//    update account to active state when button presses
    if(isset($_POST['but_active'])){
        $answer_active = filter_var($_POST['isActive'], FILTER_SANITIZE_STRING);
        if(!strcmp($answer_active, "yes")){
            $file_db->exec("update userSti set isActive = 1 where id = $userID");
        }else if(!strcmp($answer_active, 'no')){
            $file_db->exec("update userSti set isActive = 0 where id = $userID");
        }
    }
//    update account to admin state when button pressed
    if(isset($_POST['but_admin'])){
        $answer_admin = filter_var($_POST['isAdmin'], FILTER_SANITIZE_STRING);
        if(!strcmp($answer_admin, "yes")){
            $file_db->exec("update userSti set isAdmin = 1 where id = $userID");
        }else if(!strcmp($answer_admin, 'no')){
            $file_db->exec("update userSti set isAdmin = 0 where id = $userID");
        }
    }

    //    check if the account is active
    $isActive = $file_db->query("select isActive from userSti where $userID = id");
    $isActive = $isActive->fetch();
    $isActive = $isActive['isActive'];

    //    check if the account is admin
    $isAdmin = $file_db->query("select isAdmin from userSti where $userID = id");
    $isAdmin = $isAdmin->fetch();
    $isAdmin = $isAdmin['isAdmin'];
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
if($reset_success)
    echo "Password updated";
?>

<!--Possibility for the admin to change if an account is active or admin -->
<form action="" method="post">
    Active :
    <?php if($isActive){?>
        <label>
            <input type="radio" name="isActive" value="yes" checked="checked"> Yes
        </label>
        <label>
            <input type="radio" name="isActive" value="no"> No
        </label>
    <?php } else{ ?>
        <label>
            <input type="radio" name="isActive" value="yes"> Yes
        </label>
        <label>
            <input type="radio" name="isActive" value="no" checked="checked"> No
        </label>
    <?php } ?>
    <input type="submit" name="but_active" value="Submit"><br>
    Admin :
    <?php if($isAdmin){?>
        <label>
            <input type="radio" name="isAdmin" value="yes" checked="checked"> Yes
        </label>
        <label>
            <input type="radio" name="isAdmin" value="no"> No
        </label>
    <?php } else{ ?>
        <label>
            <input type="radio" name="isAdmin" value="yes"> Yes
        </label>
        <label>
            <input type="radio" name="isAdmin" value="no" checked="checked"> No
        </label>
    <?php } ?>
    <input type="submit" name="but_admin" value="Submit">
</form>

<!--Deleting account-->
</br>
<a href="adminCheckUser.php?id=<?php echo $userID?>&delete=<?php echo $userID?>"> Delete account </a>

<?php
if($delAccount){
    echo "Account deleted";
}
?>




