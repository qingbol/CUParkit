<?php
    /* Jack Tabb
     * 11/01/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/own.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner object
    $own = new Own($db);

    // Get OID from front-end
    $own->setAttr("plate", 
        isset($_GET["plate"]) ? $_GET["plate"] : die());
    $own->setAttr("oid", 
        isset($_GET["oid"]) ? $_GET["oid"] : die());

    // Get the single entry from the database, using the OID as a key
    $res = $own->read_single();

    if (count($res) > 0) { // If there were any results
        // Convert the result array into JSON and output it
        print_r(json_encode($res));
    } else { // If there are not any entries in the Owner table
        echo json_encode( array("message" => "own Not Found") );
    }
    
