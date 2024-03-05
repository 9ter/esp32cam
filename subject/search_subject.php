<?php
include("../config.php");
// Validate and sanitize input

$subject = $_GET['term'];
$sql_search = "SELECT * FROM `subject` WHERE `group` = '$subject' ";
$subject_result = $conn->query($sql_search);
// Fetch data and store in an array of objects
$data = array();
while ($row = $subject_result->fetch_assoc()) {
    $data[] = $row; // Keep the entire row, not just 'shop_name'
}

// Send data back in JSON format
echo json_encode($data);

$conn->close();

?>