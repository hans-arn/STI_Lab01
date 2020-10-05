<!--
list all users
-->

<?php
include "config.php"
?>

<!DOCTYPE html>
<html>
<body>

<h1>Admin Page</h1>

<ul>
    <li><a href="adminPage.php?listUsers"> List all users</a></li>

</ul>

</body>
</html>

<?php
    $listUsers = $_GET['listUsers'];
    if(isset($listUsers)){

        $result = $file_db->query("SELECT id, username FROM userSti");

        foreach($result as $row){
            echo "<br/>";
            echo "Id: " . $row['Id'] . "<br/>";
            echo "Username: " . $row['username'] . "<br/>";
            echo "<br/>";
        }

    }
?>

