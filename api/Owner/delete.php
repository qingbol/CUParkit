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

    /* NEW: Authorization step */
    // Make it so that an owner can only delete his own entry.
    //   and a manager can delete any entry.
    if ( ($_SESSION['id'] === $data->oid)
            || ($_SESSION['type'] === "manager")) {
        // Delete this owner using the data model's function
        if($owner->delete()) {
            echo json_encode(array('message' => 'Owner Successfully Deleted'));
        } else {
            echo json_encode(array('message' => 'Owner Not Deleted'));
        }
    } else {
        // Return error message about not being logged in / not having proper access
    }
    
