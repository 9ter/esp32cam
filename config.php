<?php
//header('Content-Type: application/json; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esp32cam_facedetection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}
//echo "Connected successfully";


?>