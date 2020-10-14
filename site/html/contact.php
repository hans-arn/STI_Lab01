<?php
include "header.php";
    if(isset($file_db)){
            $sql= "SELECT id,username FROM userSti WHERE id !=".$_SESSION['id'];
            if(isset($_GET['query'])){
                $sql .=" AND username LIKE '%".$_GET['query']."%'";
            }
            $sql .=";";
            $result =$file_db->query($sql);



?>
<div class="row justify-content-center">
<div class="col-9 " align=center>
<form method="get" action="">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="query" name="query" placeholder="Username" />
            </div>

            <div>
                <input type="submit" value="Submit"  />
            </div>
        </div>
    </form>
<?php
        foreach($result as $row){ ?>
        <p> <a href="writeMessage.php?id=<?php echo $row['id']?>"> envoyer un message</a>: <?php echo $row['username']?></p>


    <?php
            }
    }?>
</div>
</div>
