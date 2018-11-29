<?php
date_default_timezone_set('America/New_York'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Qingbo remote database
$database = 'parkit';
$user = 'qbl';
$pass = 'lqb987741';
$host = 'mysql1.cs.clemson.edu';

//Qingbo local database
// $database = 'cpsc6620';
// $user = 'root';
// $pass = '0000';
// $host = 'localhost';

$date_string = date("Ymd");
$dir = dirname(__FILE__) . '/' . $database . '_' . $date_string . '.sql';
$restore_file  = "./parkit_20181127.sql";

$cmd = "/usr/bin/mysql -h {$host} -u {$user} -p{$pass} {$database} < $restore_file";
exec($cmd);

// var_dump(get_current_user());
// $stmt = 'php -v';
// exec($stmt, $arr);
// echo '<pre>';
// var_dump($arr);
// echo "I am ~~~ \n";
// echo shell_exec('ls') ;
// echo shell_exec('whoami');
