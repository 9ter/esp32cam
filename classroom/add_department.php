<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];



    // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
    $check_sql = "SELECT * FROM department WHERE 'name' = '$name'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("มี ชื่อ ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../classroom.php";</script>';
    } else {
        $insert_sql = "INSERT INTO `department`(`name`) VALUES ('$name')";

        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../classroom.php";</script>';
        } else {
            echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../classroom.php";</script>';
        }
    }

    $conn->close();

}

?>