<?php
include("../config.php");
// Validate and sanitize input

$day = $_GET['term'];
$sql_search = "SELECT id,`group` ,`subject`, `day`, time_start, time_stop, building, room, camera, department , classroom FROM queue_setup WHERE 1";

$result = $conn->query($sql_search);
// Fetch data and store in an array of objects
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row; // Keep the entire row, not just 'shop_name'
}

// Send data back in JSON format
echo json_encode($data);

$conn->close();

?>