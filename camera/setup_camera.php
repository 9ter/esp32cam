<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $building = $_POST["building"];
    $room = $_POST["room"];
    $camera = $_POST["camera"];

    // ทำอะไรกับข้อมูลต่อไปนี้ตามความเหมาะสม เช่น บันทึกลงฐานข้อมูล หรือประมวลผลต่อ

    include("../config.php");

    $sql = "UPDATE camera SET `building` = '$building' , `room` = '$room' WHERE id= $camera";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../camera.php";</script>';
    } else {
        echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../camera.php";</script>';
    }


}
?>