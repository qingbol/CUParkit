<?php
    // Create a session or resume current session based on session ID passed via POST
    session_start();

    // Verify / Authenticate user
    if ( authUser($_POST['username'], $_POST['password']) === true ) {
        // save username and name into session memory for later use
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['name'] = getUser($_SESSION['username'])['name'];
        return $response->withRedirect('index.php', 302);
    }
    // Otherwise, if user not authenticated
    session_destroy(); // Kill the session
    // Send user back to the login page with an error message
    $err_msg = "Error Logging In: Wrong Username or Password";
    return $response->withRedirect('login.html#'.$err_msg, 302);




// HTTP Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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