<?php

$host = "YOUR_RENDER_DB_HOST";
$user = "YOUR_RENDER_DB_USER";
$pass = "YOUR_RENDER_DB_PASSWORD";
$db   = "YOUR_DATABASE";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
die("Connection failed");
}

?>