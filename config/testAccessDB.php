<?php
// NOTE: This file is using mysqli.
// The project is going to use pdo instead of mysqli, as seen in test_config.php

echo "HELLO WORLD\n";

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// $mysqli = new mysqli("localhost", "root", "", "demo");
$mysqli = new mysqli("mysql1.cs.clemson.edu", "CPSC_4620_a31t", "SoQoolLearning1", "");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. \n" . $mysqli->connect_error);
}
 
// Print host information
echo "Connect Successfully. Host info: " . $mysqli->host_info . "\n";
