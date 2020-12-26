<?php
include "header.php";
if(!empty($_POST['message']) && isset($_GET['id'])){
    // set the timezone to UTC for compatibility with other app
    date_default_timezone_set('UTC');
    //add message in the table
    $sanitized_s = filter_var($_POST['sujet'], FILTER_SANITIZE_STRING);
    $sanitized_m = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO message(receiptDate,sender,receiver,sujet,messageBody) VALUES ( '".date('Y-m-d H:i:s')."', ". $_SESSION["id"].", ". $_GET['id'];
    $sql .= ", '". $sanitized_s."', '".$sanitized_m."');";
    echo $sql;
    if($file_db->exec($sql))
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
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit"class="btn btn-primary col-6"/>
            </div>
        </div>
    </form>
