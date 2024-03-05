<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group = $_POST["group"];
    $subject =  $_POST["subject"];
    $day  =  $_POST["day"];
    $time_start =  $_POST["time_start"];
    $time_stop = $_POST["time_stop"];


    $building = $_POST["building"];
    $room = $_POST["room"];
    $camera = $_POST["camera"];
   

    $department = $_POST["department"];
    $classroom = $_POST["classroom"];
    

     // ตรวจสอบว่ามีข้อมูล camera ซ้ำกันหรือไม่
     $check_sql = "SELECT * FROM queue_setup WHERE camera = $camera ";
     $check_result = $conn->query($check_sql);

     if ($check_result->num_rows > 0) {
         echo '<script>alert("มี camera ซ้ำกัน กรุณาตรวจสอบ"); window.location.href="../subject.php";</script>';
     } else {
         $insert_sql = "INSERT INTO `queue_setup`(`group`, `subject`, `day`, `time_start`, `time_stop`, `building`, `room`, `camera`, `department`, `classroom`) 
                                          VALUES ('$group','$subject','$day','$time_start','$time_stop','$building','$room','$camera','$department','$classroom')";

         if ($conn->query($insert_sql) === TRUE) {
             echo '<script>alert("บันทึกสำเร็จ"); window.location.href="../subject.php";</script>';
         } else {
             echo '<script>alert("บันทึก ไม่สำเร็จ"); window.location.href="../subject.php";</script>';
         }
     }

     $conn->close();

   
    
}

?>