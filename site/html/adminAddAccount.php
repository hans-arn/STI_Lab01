<?php
include "headerAdmin.php";
?>

<!DOCTYPE html>
<html>
<body>

<h1>Add new account</h1>

<form method="post" action="">
    <h3>User information</h3>

    <label for="uname">Username:</label><br>
    <input type="text" id="uname" name="uname"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <label for="password">Is active:</label><br>
    <label> <input type="radio" name="isActive" value="yes"> Yes </label>
    <label> <input type="radio" name="isActive" value="no"> No </label><br>
    <label for="password">Is admin:</label><br>
    <label> <input type="radio" name="isAdmin" value="yes"> Yes </label>
    <label> <input type="radio" name="isAdmin" value="no"> No </label>

    <div>
        <input type="submit" value="Submit" name="but_submit" id="but_submit" />
    </div>
</form>

</body>
</html>

<!--Add new account to database -->
<?php
if(isset($file_db)){
    if(isset($_POST['but_submit'])){
        $uname = $_POST['uname'];
        $password = hash('md5', $_POST['password']);
        (strcmp($_POST['isActive'], 'yes')) ? $isActive=0 : $isActive=1;
        (strcmp($_POST['isAdmin'], 'yes')) ? $isAdmin=0 : $isAdmin=1;
        $insert = $file_db->prepare("insert into userSti(username, password, isAdmin, isActive) values (?,?,?,?)");
        if($insert->execute(array($uname,$password,$isActive,$isAdmin))){
            header('Location: adminPage.php');
        }

    }
}
?>

