<!--
list all users
-->

<?php
include "config.php";
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
    if(isset($_POST['but_submit'])){
        $search = $_POST['txt_uname'];
        if($search != ""){
            $result = $file_db->query("select username, id from userSti where username like '$search'");
            $result = $result->fetch();

            if(isset($result['id'])){
                echo $result['id'];
                header("Location: adminCheckUser.php?id=" . $result['id']);
            }else{
                echo "not found";
            }
        }

    }



    $listUsers = $_GET['listUsers'];
    if(isset($listUsers)){

        $result = $file_db->query("SELECT id, username FROM userSti");

        foreach($result as $row){
            echo "Username : "?>
                <a href='adminCheckUser.php?id=<?php echo $row["id"]?>'> <?php echo $row['username'] ?> </a><br/>
            <?php
        }

    }
?>

