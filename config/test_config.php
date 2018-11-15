<?php
    // Test the Database class:
    // Temporarily to see if my server supports PDO:
    include_once 'Database.php';
    $database = new Database();
    $db_cnxn = $database->connect(); // Database Connection
    echo("HELLO");
    printf("MySQL host info: %s\n", $db_cnxn->getAttribute(PDO::ATTR_CONNECTION_STATUS));
