<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "online_notes";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){

die("database is not connected: " . mysqli_connect_error($conn));

}

?>