<?php

$serverName = "localhost";
$dbUserName = "shavindi";
$dbPassword = "shavi12";
$dbName = "happystudy_login";

$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
