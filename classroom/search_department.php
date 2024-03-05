<?php
include("config.php");


$sql_search = "SELECT * FROM department WHERE 1";

$department_option = $conn->query($sql_search);
$department_table = $conn->query($sql_search);
$department_option_tabel = $conn->query($sql_search);



$conn->close();

?>