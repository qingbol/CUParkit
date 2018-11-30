<?php
date_default_timezone_set('America/New_York'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database
include_once '../../config/Database.php';

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