<?php
include("../config.php");

if (isset($_POST["room_number"],$_POST["building"],$_POST['room_name'])) {
    $name = $_POST["room_name"];
    $building = $_POST["building"];
    $room_number = $_POST['room_number'];

    // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
    $check_sql = "SELECT * FROM room WHERE name = '$name' AND room_number = '$room_number' AND building = '$building'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("ชื่อ ห้อง ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../index.php";</script>';
    } else {
        $insert_sql = "INSERT INTO `room`( `name`, `room_number`, `building`) VALUES ('$name','$room_number','$building')";

        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../index.php";</script>';
        } else {
            echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../index.php";</script>';
        }
    }

    $conn->close();
}

?>