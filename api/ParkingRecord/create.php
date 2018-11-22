<?php
    /* Jack Tabb
     * 11/01/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/ParkingRecord.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner object
    $parkingRecord = new ParkingRecord($db);

    // Get raw posted data from HTML form
    // json_decode returns an object if 'true' is not specified
    // json_decode returns an associative array if 'true' is specified
    $data = json_decode(file_get_contents("php://input"), true);

    // Fill in the Owner's data that was supplied from the front-end
    $parkingRecord->fillAttributes($data);
    
    // Create Owner entry in the database using the data model's function
    if($parkingRecord->create()) {
        echo json_encode(array('message' => 'ParkingRecord Successfully Created'));
    } else {
        echo json_encode(array('message' => 'ParkingRecord Not Created',
                                'PasswordMsg' => $parkingRecord->getMsg()
        ));
        // echo json_encode($owner->getMsg());
    }
