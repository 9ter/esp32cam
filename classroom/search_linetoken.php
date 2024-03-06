<?php
include("../config.php");
// Validate and sanitize input

$id = $_GET['id'];
$sql_search = "SELECT * FROM classroom WHERE id = $id ";
$id_result = $conn->query($sql_search);
// Fetch data and store in an array of objects
$data = array();
while ($row = $id_result->fetch_assoc()) {
    $data[] = $row; // Keep the entire row, not just 'shop_name'
}

// Send data back in JSON format
echo json_encode($data);

$conn->close();

?>