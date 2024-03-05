<?php
include("config.php");


$sql_search = "SELECT * FROM `subject` WHERE 1";

$subject_option = $conn->query($sql_search);


$conn->close();

?>