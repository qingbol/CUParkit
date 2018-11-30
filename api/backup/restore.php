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

// $date_string = date("Ymd");
// $dir = dirname(__FILE__) . '/' . $database . '_' . $date_string . '.sql';
$restore_file  = "./dump.sql";

$cmd = "/usr/bin/mysql -h {$host} -u {$user} -p{$pass} {$database} < $restore_file";
exec($cmd, $output);

$msg = array("message" => "Restoring database from " . $restore_file . "<br>");
foreach ($output as $value) {
    $msg["message"] .= $value . "<br>";
}
echo json_encode( $msg );