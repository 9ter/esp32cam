<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $building = $_POST["building"];
    $room = $_POST["room"];
    $camera = $_POST["camera_name"];

    // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
    $check_sql = "SELECT * FROM camera WHERE camera = '$camera'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("ชื่อ camera ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../camera.php";</script>';
    } else {
        $insert_sql = "INSERT INTO `camera`(`building`, `room`, `camera`, `status`) VALUES ('$building','$room','$camera',1)";

        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../camera.php";</script>';
        } else {
            echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../camera.php";</script>';
        }
    }

    $conn->close();
}

?>