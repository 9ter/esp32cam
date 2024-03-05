<?php
include("../config.php");

// Validate and sanitize input
if(isset($_GET['term'])){
    $building = $_GET['term'];

    // Use prepared statement to prevent SQL injection
    $sql_search = "SELECT * FROM room WHERE building = ?";
    $stmt = $conn->prepare($sql_search);
    
    // Bind parameter
    $stmt->bind_param("s", $building);
    
    // Execute query
    $stmt->execute();
    
    // Get result
    $building_result = $stmt->get_result();
    
    // Fetch data and store in an array of objects
    $data = array();
    while ($row = $building_result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Send data back in JSON format
    echo json_encode($data);
    
    // Close statement
    $stmt->close();
    $conn->close();
}
?>
