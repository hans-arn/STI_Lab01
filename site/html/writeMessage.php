<?php
include "header.php";
if(isset($_POST['message']) && isset($_GET['id'])){
    date_default_timezone_set('UTC');
    $sql = "INSERT INTO message(receiptDate,sender,receiver,sujet,messageBody) VALUES ( '".date('Y-m-d H:i:s')."', ". $_SESSION["id"].", ". $_GET['id'];
    $sql .= ", '". $_POST["sujet"]."', '".$_POST['message']."');";
    if($file_db->exec($sql))
     echo "votre message a bien ete envoye";
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
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit"class="btn btn-primary col-6"/>
            </div>
        </div>
    </form>
