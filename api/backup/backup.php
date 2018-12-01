<?php
date_default_timezone_set('America/New_York'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database
include_once '../../config/Database.php';

// Authorization
    // Create a session or resume current session based on session ID
    session_start();

    // If the session variables aren't set, that means the user isn't logged in
    if (!isset($_SESSION['id']) || !isset($_SESSION['type'])) {
        session_destroy();
        echo json_encode(array('message' => 'User not logged in: You don\'t have permission to do that'));
        die();
    }

    // Only an admin can backup or restore the database
    // TODO: It's probably best to make Admin seperate from Manager in the future
    if ( !($_SESSION['type'] === "manager") ) {
        session_destroy();
        echo json_encode(array('message' => 'Incorrect authority: You don\'t have permission to do that'));
        die();
    }
    // If  we've made it here, the user is a logged-in Manager, who has the right to do the following

// Instantiate DB
$dbInst = new Database();

// Get configuration details from Database
$database = $dbInst->getDB();
$user = $dbInst->getUser();
$pass = $dbInst->getPass();
$host = $dbInst->getHost();

// echo "backup.php";
// var_dump($database);
// var_dump($user);
// var_dump($pass);
// var_dump($host);

// $date_string = date("Ymd");
$backup_name = "dump";
$dir = dirname(__FILE__) . '/' . $backup_name . '.sql';

exec("/usr/bin/mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

$msg = array("message" => "Backing up database to " . $dir . "/" . $backup_name . "<br>");
foreach ($output as $value) {
    $msg["message"] .= $value . "<br>";
}
echo json_encode( $msg );