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
    include_once '../../models/ParkingSpot.php';
    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner objectt any entries in the Owner table
    $parkingSpot = new ParkingSpot($db);

    // Get OID from front-end
    $parkingSpot->setPageInfo("pageSeq", 
        isset($_GET["pageNumber"]) ? $_GET["pageNumber"] : 1 
    );
    $parkingSpot->setPageInfo("spotStatus", 
        isset($_GET["spotStatus"]) ? $_GET["spotStatus"] : "vaccant" 
    );
    // print_r(json_encode($_GET["spotStatus"]));

    // Get all rows from Owner table
    // It's an integer-indexed array of associative arrays
    $result = $parkingSpot->listAll();

    if (count($result) > 0) { // If there were any results
        // Convert the result into JSON and output it
        echo json_encode($result);
    } else { // If there are not any entries in the Owner table
        echo json_encode( array("message" => "No ParkingRecord Found") );
    }
    




