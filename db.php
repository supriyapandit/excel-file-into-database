<?php
// define('localhost','localhost');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','root');
// define('DB_NAME', 'student_details');
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "root";
$DB_name = "advertisement";

//global $con;
$con = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name) or die ("error");
// Check connection
if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();
?>
