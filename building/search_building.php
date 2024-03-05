<?php
include("config.php");


$sql_search = "SELECT * FROM building WHERE 1";
$building_result = $conn->query($sql_search);
$building1_result = $conn->query($sql_search);
$building2_result = $conn->query($sql_search);
$conn->close();

?>