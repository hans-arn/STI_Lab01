<?php
include 'headerAdmin.php';


$userID = $_GET['id'];
$delAccount = $_GET['delete'];

if(isset($file_db)){
    $get_name=$file_db->prepare("select username from userSti where  id= ? ");
    $get_name->execute([$userID]);
    $username = $get_name->fetch();
    $username = $username['username'];

//    delete account from database
    if(isset($delAccount)){
        $delQuery = $file_db->prepare('delete from userSti where id = ?');
        if($delQuery->execute([$userID]))
            header("Location: adminPage.php");

    }
//    change account password in databae
    if(isset($_POST['but_password'])){
        /*Correction: on nettoie l'entrée utilisateur*/
        $uname = filter_var($_POST['txt_uname'], FILTER_SANITIZE_STRING);
        $password = $_POST['txt_pwd'];

        if (!empty($password)){
            if(isset($file_db)){
                $reset_success = 0;
                $updatePassQuery = $file_db->prepare('update userSti set password = ?  where id = ?');
                /*Correction: on hash le mot de passe avec Bcrypt*/
                if($updatePassQuery->execute([ password_hash($password, PASSWORD_BCRYPT),$userID])){
                    $reset_success = 1;
                }
            }
        }
    }
//    update account to active state when button presses
    if(isset($_POST['but_active'])){
        /*Correction: on nettoie l'entrée utilisateur*/
        $answer_active =filter_var($_POST['isActive'], FILTER_SANITIZE_STRING);
        $isActive=0;

        if(!strcmp($answer_active, "yes")){
            $isActive=1;
        }
        $changeActiveQuery = $file_db->prepare("update userSti set isActive = ? where id = ?");
        $changeActiveQuery->execute([$isActive,$userID]);
    }
//    update account to admin state when button pressed
    if(isset($_POST['but_admin'])){
        /*Correction: on nettoie l'entrée utilisateur*/
        $answer_admin = filter_var($_POST['isAdmin'], FILTER_SANITIZE_STRING);
        $isAdmin=0;

        if(!strcmp($answer_admin, "yes")){
            $isAdmin=1;
        }
        var_dump($isAdmin);
        $changeActiveQuery = $file_db->prepare("update userSti set isAdmin = ? where id = ?");
        $changeActiveQuery->execute([$isAdmin,$userID]);
    }

    //    check if the account is active
    $isActiveQuery = $file_db->prepare("select isActive from userSti where id=?");
    $isActiveQuery->execute([$userID]);
    $isActive = $isActiveQuery->fetch();
    $isActive = $isActive['isActive'];

    //    check if the account is admin
    $isAdminQuery = $file_db->prepare("select isAdmin from userSti where id=?");
    $isAdminQuery->execute([$userID]);
    $isAdmin = $isAdminQuery->fetch();
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
if($delAccount)
    echo "Account deleted";
?>
