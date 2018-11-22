<?php
    /* Jack Tabb
     * 11/02/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/ParkingSpot.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner object
    $parkingSpot = new ParkingSpot($db);

    // Get raw posted data from HTML form
    // json_decode returns an object if 'true' is not specified
    // json_decode returns an associative array if 'true' is specified
    $data = json_decode(file_get_contents("php://input"), true);

    // Fill in the Owner's data that was supplied from the front-end
    $parkingSpot->fillAttributes($data);
    // $tel = $owner->getAttr("tel");
    
    // Create Owner entry in the database using the data model's function
    if($parkingSpot->update()) {
        // echo json_encode(array('message' => 'Owner Successfully Updated',
        //                         'tel' => $tel
        // ));
        echo json_encode(array('message' => 'ParkingSpot Successfully Updated'));
    } else {
        echo json_encode(array('message' => 'ParkingSpot Not Updated'));
    }
