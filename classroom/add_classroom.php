<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = $_POST["department"];
    $level = $_POST["level"];
    $sublevel = $_POST["sublevel"];
    $class = $_POST["class"];
    $line_token = $_POST["line_token"];

    if ($department != "null") {

        // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
        $check_sql = "SELECT * FROM classroom WHERE 'level' = '$level' AND 'class' = '$class'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo '<script>alert("มี class ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../classroom.php";</script>';
        } else {
            $insert_sql = "INSERT INTO `classroom`(`department`, `level`,`sublevel`, `class`, `line_token`) VALUES ('$department','$level','$sublevel','$class','$line_token')";

            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../classroom.php";</script>';
            } else {
                echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../classroom.php";</script>';
            }
        }

        $conn->close();
    }
}

?>