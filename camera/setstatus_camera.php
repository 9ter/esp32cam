<?php
include("../config.php");

// Validate and sanitize input
if (isset($_GET['id'], $_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $sql = "UPDATE camera SET `status` = '$status' WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../camera.php";</script>';
    } else {
        echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../camera.php";</script>';
    }


    $conn->close();
}
?>