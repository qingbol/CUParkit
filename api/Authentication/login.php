<?php
    // HTTP Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Include the database
    include_once '../../config/Database.php';

    // Include the data model that communicates to the database
    include_once '../../models/Owner.php';
    include_once '../../models/Manager.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate an Owner object
    $owner = new Owner($db);
    // Instantiate Manager object
    $manager = new Manager($db);

    // Get raw posted data from HTML form
    // json_decode returns an object if 'true' is not specified
    // json_decode returns an associative array if 'true' is specified
    $data = json_decode(file_get_contents("php://input"));

    // We don't know if the id supplied from the front-end is oid or mid yet
    // Set OID to the one specified from the front-end
    $owner->setAttr("oid", $data->id);
    // Set MID to the id
    $manager->setAttr("mid", $data->id);
    // Get the single entry from the database, using the ID as a key
    $owner_info = $owner->read_single();
    $manager_info = $manager->read_single();

    // If there wasn't any result from the database
    // Meaning the user needs to register or probably didn't spell his username correctly
    // echo json_encode( array("message" => "Printing result:") );
    // print_r(json_encode($res));
    if (!($owner_info || $manager_info)) {
        die(json_encode(array("message" => "ERROR: User Not Found") ));
    }

    $pass_from_db;
    $id;
    $type;
    // If one of the info pieces has a correct username, then we need to handle it properly
    if ($owner_info) { // If it's an owner who's logging in
        $pass_from_db = $owner_info['pass'];
        // echo json_encode(array("OwnerPass" => $owner_info['Password']));
        $id = $owner->getAttr('oid');
        $type = $owner_info['type'];
    }

    if ($manager_info) { // If it's a manager who's logging in
        $pass_from_db = $manager_info['Password'];
        // echo json_encode(array("ManagerPass" => $manager_info['Password']));
        $id = $manager->getAttr('mid');
        $type = "manager";
    }

    // If the database found the user:
    // Create a session or resume current session based on session ID passed via POST
    session_start();

    // Verify / Authenticate the user using PHP's built-in hash checker
    //  and the password supplied by the user and the password hash from the database
    // password_verify("password1234", hashedPasswordFromDB);
    if (password_verify($data->pass, $pass_from_db)) {
        // This is a verfied user. Store the relevant info into the session 
        // that now exists between him and the server
        $_SESSION['id'] = $id;
        // Store type of user from database into the session
        $_SESSION['type'] = $type;
        
        echo json_encode(array("message" => "Password is valid"));
    } else {
        session_destroy();
        echo json_encode(array("message" => "Invalid Password"));
    }