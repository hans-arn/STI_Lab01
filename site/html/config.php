
<?php

// Set default timezone
date_default_timezone_set('UTC');

try{
    /**************************************
     * Create databases and                *
     * open connections                    *
     **************************************/

    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
}


