<?php
include("../config.php");

if (isset($_POST["name"],$_POST["building_name"])) {
    $name = $_POST["name"];
    $building_name = $_POST["building_name"];

    // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
    $check_sql = "SELECT * FROM building WHERE name = '$name' AND building_name = '$building_name' ";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("ชื่อ อาคาร ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../index.php";</script>';
    } else {
        $insert_sql = "INSERT INTO `building`(`name`, `building_name`) VALUES ('$name','$building_name')";

        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../index.php";</script>';
        } else {
            echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../index.php";</script>';
        }
    }

    $conn->close();
}

?>