<?php
    /* Jack Tabb
     * 11/02/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/Owner.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner object
    $owner = new Owner($db);

    // Get raw posted data from HTML form
    // json_decode returns an object if 'true' is not specified
    // json_decode returns an associative array if 'true' is specified
    $data = json_decode(file_get_contents("php://input"));

    // Set OID to the one specified from the front-end
    $owner->setAttr("oid", $data->oid);
    $oidRec = $data->oid;

    // Delete this owner using the data model's function
    if($owner->delete()) {
        echo json_encode(array('message' => 'Owner Successfully Deleted',
                                'OID RECEIVED: ' => $oidRec
        ));
    } else {
        echo json_encode(array('message' => 'Owner Not Deleted'));
    }
