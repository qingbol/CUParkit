<?php
date_default_timezone_set('America/New_York'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database
include_once '../../config/Database.php';

// Instantiate DB & connect to it
$dbInst = new Database();
$db = $dbInst->connect();

// Get configuration details from Database
$database = $db->getDB();
$user = $db->getUser();
$pass = $db->getPass();
$host = $db-getHost();

// $date_string = date("Ymd");
$backup_name = "dump";
$dir = dirname(__FILE__) . '/' . $backup_name . '.sql';

// echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
echo json_encode( array("message" => "Backing up database to " + $dir) );

exec("/usr/bin/mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

var_dump($output);