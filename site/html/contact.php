<?php
//print users to send a message
include "header.php";
    if(isset($file_db)){
    // print all other users
    $params[] = $_SESSION['id'];
    $query = "SELECT id,username FROM userSti WHERE id != ?";
/*Correction: Token anti-CSRF*/
        if(isset($_GET['query'])&&$_GET['query']!="" && hash_equals($_POST['token'],$_SESSION['token'])){
            $params[]="%".$_GET['query']."%";
            //add a condition to print only username that match with the substring
            $query .=" AND username like ?";
        }
        $query .=";";
        $result=$file_db->prepare($query);
        $result->execute($params);
        $result =$result->fetchAll();
?>
<div class="row justify-content-center">
<div class="col-9 " align=center>
<form method="get" action="">
            <h1>Envoyer un message a</h1>
            <div>
                <input type="text" class="textbox" id="query" name="query" placeholder="Username" />
            </div>
            <!-- Correction: Token anti-CSRF -->
            <div>
                <input type="hidden" class="form-control" id="txt_token"  name="token" value="<?=$_SESSION['token']?>"/>
            </div>
            <div>
                <input type="submit" value="Submit"  />
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
