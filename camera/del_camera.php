<?php
include("../config.php");

// Validate and sanitize input
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `camera`  WHERE id= $id AND status= 0";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ลบสำเร็จ"); window.location.href="../camera.php";</script>';
    } else {
        echo '<script>alert("ลบ ไม่สำเร็จ"); window.location.href="../camera.php";</script>';
    }

    $conn->close();
}

if (isset($_GET['all'])) {
    $sql = "DELETE FROM `camera`  WHERE status= 0";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ลบทั้งหมดสำเร็จ"); window.location.href="../camera.php";</script>';
    } else {
        echo '<script>alert("ลบ ไม่สำเร็จ"); window.location.href="../camera.php";</script>';
    }
}
?>