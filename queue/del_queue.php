<?php
include("../config.php");

// Validate and sanitize input
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `queue_setup`  WHERE id= $id ";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ลบสำเร็จ"); window.location.href="../subject.php";</script>';
    } else {
        echo '<script>alert("ลบ ไม่สำเร็จ"); window.location.href="../subject.php";</script>';
    }

    $conn->close();
}

if (isset($_GET['all'])) {
    $sql = "DELETE FROM `queue_setup`  WHERE 1";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ลบทั้งหมดสำเร็จ"); window.location.href="../subject.php";</script>';
    } else {
        echo '<script>alert("ลบ ไม่สำเร็จ"); window.location.href="../subject.php";</script>';
    }
}
?>