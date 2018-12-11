<?php
include('connect.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$txtPlaces = $_POST['txtPlaces'];

// Use preg_split() function
$string = $txtPlaces;
$str_arr = preg_split ("/\,/", $string);
//print_r($str_arr);

// use of explode
$string = $txtPlaces;
$str_arr = explode (",", $string);
//print_r($str_arr);

try {
    $sql = "INSERT INTO admin_ads (firstname, lastname, mobile, address, city, state, country)
    VALUES ('$firstname', '$lastname', '$mobile', '$address', '$str_arr[0]', '$str_arr[1]', '$str_arr[2]')";
    //print_r($sql);
    // use exec() because no results are returned
    $DB_con->exec($sql);

   echo "New record created successfully";

   }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$DB_con = null;
?>
