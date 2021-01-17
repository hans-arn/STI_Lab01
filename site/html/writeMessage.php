<?php
include "header.php";
if(!empty($_POST['message']) && isset($_GET['id']) && hash_equals($_POST['token'],$_SESSION['token'])){
    /*Correction: Token anti-CSRF*/
    // set the timezone to UTC for compatibility with other app
    date_default_timezone_set('UTC');
    //add message in the table
    $sql = "INSERT INTO message(receiptDate,sender,receiver,sujet,messageBody) VALUES ( '".date('Y-m-d H:i:s')."', ?, ?";
    $sql .= ", ?, ?);";
    $sendMessageQuery = $file_db->prepare($sql);
    /*Correction: les entrées utilisateurs sont nettoyées*/
    $params=[$_SESSION['id'],$_GET['id'], filter_var($_POST['sujet'], FILTER_SANITIZE_STRING), filter_var($_POST['message'], FILTER_SANITIZE_STRING)];
    if($sendMessageQuery->execute($params))

     echo "votre message a bien ete envoye ";
    else
     echo "veuillez ressayer plus tard";

}
?>
    <form method="post" action="">
        <div id="div_message" class="container" align=center>
            <h1>Message</h1>
            <div>
                <input type="text" class="form-control" id="sujet" name="sujet" placeholder="sujet" />
            </div>
            <div>
                <textarea  class="form-control"  id="message" name="message" placeholder="message" rows="4"></textarea>
            </div>
            <!-- Correction: Token anti-CSRF -->
            <div>
                <input type="hidden" class="form-control" id="txt_token"  name="token" value="<?=$_SESSION['token']?>"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit"class="btn btn-primary col-6"/>
            </div>
        </div>
    </form>
