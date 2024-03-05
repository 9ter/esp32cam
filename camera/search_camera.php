<?php
include("config.php");


$sql_search = "SELECT * FROM camera WHERE 1";
$camera_table = $conn->query($sql_search);
$camera_option = $conn->query($sql_search);
$camera_tablenonactive = $conn->query($sql_search);

$conn->close();

?>