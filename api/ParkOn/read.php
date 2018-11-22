<?php
    /* Jack Tabb
     * 11/01/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: GET');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/ParkOn.php';
    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner objectt any entries in the Owner table
    $parkOn = new ParkOn($db);

    // Get all rows from Owner table
    // It's an integer-indexed array of associative arrays
    $result = $parkOn->read();

    if (count($result) > 0) { // If there were any results
        // Convert the result into JSON and output it
        echo json_encode($result);
    } else { // If there are not any entries in the Owner table
        echo json_encode( array("message" => "No ParkOn Found") );
    }
    




