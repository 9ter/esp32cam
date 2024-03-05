<?php
include("../config.php");
// Validate and sanitize input

$building = $_POST['building'];
$room = $_POST['room'];
// Prepare statement
$stmt = $conn->prepare("SELECT * FROM camera WHERE building = ? AND room = ? AND status = 1");
// Bind parameters
$stmt->bind_param("ss", $building, $room);
// Set parameters and execute
$stmt->execute();
$result = $stmt->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$stmt->close();
$conn->close();

?>