<?php
    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // TODO: Make this login.php work for both Owner or Manager

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

    // Get the single entry from the database, using the OID as a key
    $res = $owner->read_single();

    // If there wasn't any result from the database
    // Meaning the user needs to register or probably didn't spell his username correctly
    if (count($res) === 0) {
        die(json_encode(array("message" => "ERROR: Owner Not Found") ));
    }

    // If the database found the user:
    // Create a session or resume current session based on session ID passed via POST
    session_start();

    // Verify / Authenticate the user using PHP's built-in hash checker
    //  and the password supplied by the user and the password hash from the database
    // password_verify("password1234", hashedPasswordFromDB);
    if (password_verify($data->pass, $res['Password'])) {
        // This is a verfied user. Store the relevant info into the session 
        // that now exists between him and the server
        $_SESSION['id'] = $owner->getAttr('oid');
        $_SESSION['type'] = $owner->getAttr('type');
        echo json_encode(array("message" => "Password is valid"));
    } else {
        session_destroy();
        echo json_encode(array("message" => "Invalid Password"));
    }