<?php
//print users to send a message
include "header.php";
    if(isset($file_db)){
    // print all other users
            $sql= "SELECT id,username FROM userSti WHERE id !=".$_SESSION['id'];
            if(isset($_GET['query'])){
                //add a condition to print only username that match with the substring
                $sql .=" AND username LIKE '%".$_GET['query']."%'";
            }
            $sql .=";";
            $result =$file_db->query($sql);



?>
<div class="row justify-content-center">
<div class="col-9 " align=center>
<form method="get" action="">
            <h1>Envoyer un message a</h1>
            <div>
                <input type="text" class="textbox" id="query" name="query" placeholder="Username" />
            </div>

            <div>
                <input type="submit" value="Submit"  />
            </div>
    </form>
<?php
        foreach($result as $row){ ?>
        //add a link to send message
        <p> <a href="writeMessage.php?id=<?php echo $row['id']?>"> envoyer un message</a>: <?php echo $row['username']?></p>
    <?php
            }
    }?>
</div>
</div>
