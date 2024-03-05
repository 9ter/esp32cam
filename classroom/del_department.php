<?php
include("../config.php");

// Validate and sanitize input
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `department`  WHERE id= $id";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ลบสำเร็จ"); window.location.href="../classroom.php";</script>';
    } else {
        echo '<script>alert("ลบ ไม่สำเร็จ"); window.location.href="../classroom.php";</script>';
    }

    $conn->close();
}

?>