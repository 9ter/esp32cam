<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values sent via POST parameters
    $folderName = isset($_POST['camera']) ? $_POST['camera'] : '';
    $Date = isset($_POST['date']) ? $_POST['date'] : '';
    $startTime = isset($_POST['time_start']) ? $_POST['time_start'] : '';
    $endTime = isset($_POST['time_stop']) ? $_POST['time_stop'] : '';
    $line_token = isset($_POST['line']) ? $_POST['line'] : '';

    $response = array(
        'status' => 'success',
        'message' => 'Received data successfully.',
        'camera' => $folderName, // Fix this line
        'date' => $Date, // Fix this line
        'time_start' => $startTime,
        'time_stop' => $endTime,
        'line_token' => $line_token
    );

    // Convert the response array to JSON format and echo it
    echo json_encode($response);
}


?>