<?php
    /* Jack Tabb
     * 11/02/2018
    */

    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    // NOTE: It appears that our school-hosted server doesn't allow DELETE Methods.
    // So, Use (POST) and set a header to (X-HTTP-Method-Override = DELETE)
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
    // print_r(json_encode($data));
    // print_r(json_encode($data->oid));
    // Set OID to the one specified from the front-end
    // $owner->setAttr("oid", json_encode($data->oid));
    $owner->setAttr("oid",$data->oid);
    // $usrid = $owner->getAttr("oid");
    // print_r($usrid);

    // Create a session or resume current session based on session ID passed via POST
    session_start();

    // If the session variables aren't set, that means the user isn't logged in
    if (!isset($_SESSION['id']) || !isset($_SESSION['type'])) {
        session_destroy();
        echo json_encode(array('message' => 'User not logged in: You don\'t have permission to do that'));
        die();
    }

    // Make it so that an owner can only delete his own entry.
    //   and a manager can delete any entry.
    if ( !(($_SESSION['id'] === $owner->getAttr("oid")) ||
            ($_SESSION['type'] === "manager")) ) {
        session_destroy();
        echo json_encode(array('message' => 'Incorrect authority: You don\'t have permission to do that'));
        die();
    }

    // // If we've made it this far, the user is authorized to use the delete function
    // //Delete this owner using the data model's function
    if($owner->delete()) {
        // echo json_encode(array('message' => 'Owner Successfully Deleted'));
        echo json_encode(array('message' => 'Owner Successfully Deleted',
                                'id: ' => $_SESSION['id']));
        // TODO: If the delete request came from a normal user, log the normal user out
        //      because they just deleted their database entry.

    } else {
        echo json_encode(array('message' => 'Owner Not Deleted'));
    }
    
