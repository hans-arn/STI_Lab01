<?php
include "headerAdmin.php";
?>

<!DOCTYPE html>
<html>
<body>

<h1>Admin Page</h1>

    <form method="post" action="">
            <h3>Search user</h3>
            <div>
                <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
            </div>

            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
    </form>

<ul>
    <li><a href="adminPage.php?listUsers"> List all users</a></li>

</ul>

</body>
</html>

<?php
if(isset($file_db)){
//    Search account by username

    if(isset($_POST['but_submit'])){
        $search = $sanitized_c = filter_var($_POST['txt_uname'], FILTER_SANITIZE_STRING);
        if(!empty($search)){
            $result = $file_db->query("select username, id from userSti where username like '$search'");
            $result = $result->fetch();

            if(isset($result['id'])){
                echo $result['id'];
                header("Location: adminCheckUser.php?id=" . $result['id']);
            }else
                echo "not found";
        }

    }

//    List all users from database
    $listUsers = $_GET['listUsers'];
    if(isset($listUsers)){

        $result = $file_db->query("SELECT id, username FROM userSti");

        foreach($result as $row){
            echo "Username : "?>
                <a href='adminCheckUser.php?id=<?php echo $row["id"]?>'> <?php echo $row['username'] ?> </a><br/>
            <?php
        }

    }
    if(isset($file_db)) {
        if (isset($_POST['but_addAccount'])) {
            header('Location: adminAddAccount.php');
        }
    }
}
?>
<form method="post" action ="">
    <div>
        </br>
        <input type="submit" name="but_addAccount" value="Add new account" id="but_addAccount">
    </div>
</form>
