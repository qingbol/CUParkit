<?php
    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/Manager.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a Manager object
    $manager = new Manager($db);

    // Get raw posted data from HTML form
    // json_decode returns an object if 'true' is not specified
    // json_decode returns an associative array if 'true' is specified
    $data = json_decode(file_get_contents("php://input"));

    // Set OID to the one specified from the front-end
    $manager->setAttr("mid", $data->id);

    // Get the single entry from the database, using the OID as a key
    $manager_info = $manager->read_single();

    // If there wasn't any result from the database
    // Meaning the user needs to register or probably didn't spell his username correctly
    // echo json_encode( array("message" => "Printing result:") );
    // print_r(json_encode($res));
    if (!$manager_info) {
        die(json_encode(array("message" => "ERROR: Manager Not Found") ));
    }

    // If the database found the user:
    // Create a session or resume current session based on session ID passed via POST
    session_start();

    // Verify / Authenticate the user using PHP's built-in hash checker
    //  and the password supplied by the user and the password hash from the database
    // password_verify("password1234", hashedPasswordFromDB);
    if (password_verify($data->pass, $manager_info['Password'])) {
        // This is a verfied user. Store the relevant info into the session 
        // that now exists between him and the server
        $_SESSION['id'] = $manager->getAttr('mid');
        // Store type of user from into the session. We know it's a manager because it's in this file
        $_SESSION['type'] = "manager";
        
        echo json_encode(array("message" => "Password is valid"));
    } else {
        session_destroy();
        echo json_encode(array("message" => "Invalid Password"));
    }