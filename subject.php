<?php

include('building/search_building.php');
include('classroom/search_department.php');
include('subject/search_subjectgroup.php');



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RIETC</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css?v=3" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css?v=1" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>

                    </h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i class="fa fa-building me-2"></i>BUILDING</a>
                    <a href="camera.php" class="nav-item nav-link "><i class="fa fa-camera me-2"></i>CAMERA</a>
                    <a href="classroom.php" class="nav-item nav-link "><i
                            class="fa fa-graduation-cap me-2"></i>CLASSROOM</a>
                    <a href="subject.php" class="nav-item nav-link active"><i
                            class="fa fa-graduation-cap me-2"></i>SUBJECT</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <!--<form method="get" action="shop.php" class="d-none d-md-flex ms-4">
                    <input type="text" class="form-control" id="search-input" placeholder="ชื่อร้านค้า..."
                        oninput="showResults(this.value)" name="shop_name" autocomplete="off"
                        style="background-color: #ffffff;" required>
                    <div id="search-results"></div>
                    <button type="submit" class="btn btn-primary rounded-pill m-2">ค้นหา</button>
                </form>-->
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!--<img class="rounded-circle me-lg-2"
                                src="https://i.pinimg.com/originals/1c/ec/60/1cec60b076ed3e42a0a253548370a353.gif"
                                alt="" style="width: 40px; height: 40px;">-->
                            <span class="d-none d-lg-inline-flex">

                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <p class="mb-2">เวลา</p>
                                <h6 class="mb-0">

                                    <h6 class="mb-0" id="time">

                                    </h6>
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">ตั้งค่าวิชา</h6>
                            <form action="queue/add_queue.php" method="post" onsubmit="return validateForm()">
                                <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->

                                <div class="form-floating mb-3">
                                    <select class="form-select" name="group" id="group"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>หมวด</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($subject_option)) {
                                            echo ' <option value="' . $row['group'] . '">' . $row['group'] . ' </option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="">หมวด</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="subject" id="subject"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>วิชา</option>
                                    </select>
                                    <label for="room">วิชา</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="day" id="day"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>เลือกวัน</option>
                                        <option value="1">จันทร์</option>
                                        <option value="2">อังคาร</option>
                                        <option value="3">พุธร</option>
                                        <option value="4">พฤหัสบดี</option>
                                        <option value="5">ศุกร์</option>
                                    </select>
                                    <span class="input-group-text">เลือกเวลาเริ่มถ่ายรูป</span>
                                    <input type="time" id="appt" name="time_start" required />

                                    <span class="input-group-text">เลือกเวลาส่งถ่ายรูป</span>
                                    <input type="time" id="appt" name="time_stop" required />


                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="building" id="building"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>อาคาร</option>
                                        <?php while ($row = mysqli_fetch_assoc($building_result)) {
                                            echo ' <option value="' . $row['name'] . '">' . $row['name'] . ' - ' . $row['building_name'] . '</option>';
                                        } ?>
                                    </select>
                                    <span class="input-group-text">-</span>
                                    <select class="form-select" name="room" id="room"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>ห้อง</option>
                                    </select>
                                    <span class="input-group-text">-</span>
                                    <select class="form-select" name="camera" id="camera"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>กล้อง</option>

                                    </select>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="department" id="department"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>แผนก</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($department_option)) {
                                            echo ' <option value="' . $row['name'] . '">' . $row['name'] . ' </option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="department">แผนก</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="classroom" id="classroom"
                                        aria-label="Floating label select example">
                                        <option value="null" selected>ห้อง</option>
                                    </select>
                                    <label for="classroom">ห้อง</label>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">เพิ่มวิชา</h6>
                            <form action="subject/add_subject.php" method="post" onsubmit="return validateForm2();">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="group" id=""
                                        aria-label="Floating label select example">
                                        <option value="วิชาอุตสาหกรรม" selected>วิชาอุตสาหกรรม</option>
                                        <option value="วิชาอุตสาหกรรม">วิชาสามัญ</option>
                                        <option value="วิชาพาณิชยกรรม">วิชาพาณิชยกรรม</option>
                                        <option value="วิชาศิลปกรรม">วิชาศิลปกรรม</option>
                                        <option value="วิชาคหกรรม">วิชาคหกรรม</option>
                                        <option value="วิชาเกษตรกรรม">วิชาเกษตรกรรม</option>
                                        <option value="วิชาประมง">วิชาประมง</option>
                                        <option value="วิชาอุตสาหกรรมท่องเที่ยว">วิชาอุตสาหกรรมท่องเที่ยว</option>
                                        <option value="อุตสาหกรรมสิ่งทอ">อุตสาหกรรมสิ่งทอ</option>
                                        <option value="วิชาเทคโนโลยีสารสนเทศและการสื่อสาร">
                                            วิชาเทคโนโลยีสารสนเทศและการสื่อสาร</option>
                                        <option value="วิชาอุตสาหกรรมบันเทิงและดนตรี">วิชาอุตสาหกรรมบันเทิงและดนตรี
                                        </option>
                                        <option value="วิชาเกษตรกรรม">วิชาเกษตรกรรม</option>
                                    </select>
                                    <label for="building">หมวด</label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ชื่อวิชา</label>
                                    <input type="text" class="form-control" placeholder="ชื่อวิชา" name="name"
                                        autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ------------------ -->
            <!-- //////////////////////////////////////////////////// -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">QUEUE</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">หมวด</th>
                                    <th scope="col">วิชา</th>
                                    <th scope="col">วัน</th>
                                    <th scope="col">เริ่มถ่าย</th>
                                    <th scope="col">ส่งรูป</th>
                                    <th scope="col">อาคาร</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col">กล้อง</th>
                                    <th scope="col">แผนก</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col" class="text-primary">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">หมวด</th>
                                    <th scope="col">วิชา</th>
                                    <th scope="col">วัน</th>
                                    <th scope="col">เริ่มถ่าย</th>
                                    <th scope="col">ส่งรูป</th>
                                    <th scope="col">อาคาร</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col">กล้อง</th>
                                    <th scope="col">แผนก</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col" class="text-primary">ลบ</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Sales End -->

            <!-- Recent Sales End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <script>

        function validateForm() {
            var group = document.getElementById('group').value;
            var subject = document.getElementById('subject').value;
            var day = document.getElementById('day').value;
            var building = document.getElementById('building').value;
            var room = document.getElementById('room').value;
            var camera = document.getElementById('camera').value;
            var department = document.getElementById('department').value;
            var classroom = document.getElementById('classroom').value;

            if (group == "null" || subject == "null" || day == "null" || building == "null" || room == "null" || camera == "null" || department == "null" || classroom == "null") {
                alert("กรุณาเลือกทุกช่อง");
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function () {
            var groupSelect = document.getElementById("group");
            var buildingSelect = document.getElementById("building");
            var roomSelect = document.getElementById("room");
            var departmentSelect = document.getElementById("department");

            var roomDropdown = $('#room'); classroom
            var subjectDropdown = $('#subject');
            var cameraDropdown = $('#camera');
            var classroomDropdown = $('#classroom');



            var tableBody = $('#myTable tbody'); // เลือกตารางที่มี ID เป็น myTable และ tbody

            groupSelect.addEventListener("change", function () {
                if (groupSelect.value != "null") {
                    $.ajax({
                        url: 'subject/search_subject.php',
                        type: 'GET',
                        data: { term: groupSelect.value },
                        dataType: 'json',
                        success: function (data) {
                            var dataArray = Object.keys(data).map(function (key) {
                                return data[key];
                            });
                            subjectDropdown.empty();
                            for (var i = 0; i < dataArray.length; i++) {
                                subjectDropdown.append($('<option></option>').attr('value', dataArray[i].name).text(dataArray[i].name));
                            }
                        }
                    });
                } else { roomDropdown.empty(); }
            });

            buildingSelect.addEventListener("change", function () {
                if (buildingSelect.value != "null") {
                    $.ajax({
                        url: 'building/search_room.php',
                        type: 'GET',
                        data: { term: buildingSelect.value },
                        dataType: 'json',
                        success: function (data) {
                            var dataArray = Object.keys(data).map(function (key) {
                                return data[key];
                            });
                            roomDropdown.empty();
                            for (var i = 0; i < dataArray.length; i++) {
                                roomDropdown.append($('<option></option>').attr('value', dataArray[i].room_number).text(dataArray[i].name));
                            }
                        }
                    });
                } else { roomDropdown.empty(); }

            });
            roomSelect.addEventListener("change", function () {
                if (roomSelect.value != "null") {
                    $.ajax({
                        url: 'camera/search_cameraroom.php',
                        type: 'POST',
                        data: { building: buildingSelect.value, room: roomSelect.value },
                        dataType: 'json',
                        success: function (data) {
                            var dataArray = Object.keys(data).map(function (key) {
                                return data[key];
                            });

                            cameraDropdown.empty();
                            for (var i = 0; i < dataArray.length; i++) {
                                cameraDropdown.append($('<option></option>').attr('value', dataArray[i].camera).text(dataArray[i].camera));
                            }
                        }
                    });
                }
            });

            departmentSelect.addEventListener("change", function () {
                //console.log(departmentSelect.value);
                if (departmentSelect.value != "null") {
                    $.ajax({
                        url: 'classroom/search_classroom.php',
                        type: 'GET',
                        data: { term: departmentSelect.value },
                        dataType: 'json',
                        success: function (data) {
                            var dataArray = Object.keys(data).map(function (key) {
                                return data[key];
                            });

                            classroomDropdown.empty();
                            for (var i = 0; i < dataArray.length; i++) {
                                classroomDropdown.append($('<option></option>').attr('value', dataArray[i].id).text(dataArray[i].level + " " + dataArray[i].sublevel + " ห้อง " + dataArray[i].class));
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: 'queue/search_queuetable.php',
                type: 'GET',
                data: { term: 1 },
                dataType: 'json',
                success: function (data) {
                    var dataArray = Object.keys(data).map(function (key) {
                        return data[key];
                    });

                    var tbody = $('.table tbody');
                    tbody.empty(); // Clear existing rows

                    dataArray.forEach(function (rowData) {
                        var row = $('<tr>');
                        Object.values(rowData).forEach(function (value) {
                            row.append($('<td>').text(value));
                        });

                        // Append delete button
                        row.append($('<td>').html('<a href="queue/del_queue.php?id=' + rowData.id + '" class="btn btn-danger">Delete</a>'));

                        tbody.append(row);
                    });
                }
            });


        });

        // เรียกใช้งาน Element ที่มี id เป็น "time"
        var timeElement = document.getElementById("time");

        // สร้างฟังก์ชันเพื่ออัปเดตเวลาทุกๆ 1 นาที
        function updateTime() {
            // สร้างวัตถุ Date เพื่อรับค่าเวลาปัจจุบัน
            var currentTime = new Date();
            var currentDate = new Date();
            var dayNumber = currentDate.getDay() || 7; // วันอาทิตย์จะได้เลข 0 จึงเราใช้ || 7 เพื่อเปลี่ยนเลข 0 เป็น 7
            console.log("day -> " + dayNumber)

            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, "0"); // เดือนเริ่มที่ 0 (มกราคม) จึงต้องเพิ่ม 1 เพื่อให้เป็นตัวแทนของเดือนจริง
            var day = currentDate.getDate().toString().padStart(2, "0");
            // จัดรูปแบบใหม่เป็นปี-เดือน-วัน
            var formattedDate = year + "" + month + "" + day;

            //console.log(formattedDate);


            // เก็บชั่วโมง (hours) และนาที (minutes)
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();

            // แปลงเวลาให้อยู่ในรูปแบบสองหลัก
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;

            // สร้างข้อความที่จะแสดงใน Element "time"
            var timeString = hours + ":" + minutes;
            console.log("time -> " + timeString)
            // กำหนดข้อความที่สร้างให้กับ innerHTML ของ Element "time"
            timeElement.innerHTML = timeString;


            let line_token = "";
            $.ajax({
                url: 'queue/search_queue.php',
                type: 'GET',
                data: { term: dayNumber },
                dataType: 'json',
                success: function (data) {
                    var dataArray = Object.keys(data).map(function (key) {
                        return data[key];
                    });

                    //console.log(dataArray);
                    for (var i = 0; i < dataArray.length; i++) {

                        var timeParts = dataArray[i].time_stop.split(":");
                        var hoursParts = parseInt(timeParts[0]);
                        var minutesParts = parseInt(timeParts[1]);

                        let camera = dataArray[i].camera
                        let time_start = dataArray[i].time_start
                        let time_stop = dataArray[i].time_stop

                        if (hoursParts == hours && minutesParts == minutes) {
                            console.log("id - >" + dataArray[i].classroom);

                            $.ajax({
                                url: 'classroom/search_linetoken.php',
                                type: 'GET',
                                data: {
                                    id: dataArray[i].classroom
                                },
                                dataType: 'json',
                                success: function (data) {
                                    var dataArraygetline = Object.keys(data).map(function (key) {
                                        return data[key];
                                    });

                                    line_token = dataArraygetline[0].line_token;
                                    console.log("line_token -> " + line_token);

                                    if (line_token != "") {
                                        console.log("send esp32 ok")
                                        $.ajax({
                                            url: 'http://172.16.1.158/ESP32-CAMPHP/combine_image2.php',
                                            type: 'GET',
                                            data: {
                                                camera: camera,
                                                date: formattedDate,
                                                time_start: time_start,
                                                time_stop: time_stop,
                                                line: line_token
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                
                                            }
                                        });
                                    }

                                }
                            });

                            console.log("camera -> " + camera);
                            console.log("date -> " + formattedDate);
                            console.log("time_start -> " + time_start);
                            console.log("time_stop -> " + time_stop);

                        }
                    }
                }
            });
        }

        // เรียกใช้งานฟังก์ชันเพื่ออัปเดตเวลาเริ่มต้น
        updateTime();

        // ใช้ setInterval เพื่อเรียกใช้งานฟังก์ชัน updateTime ทุกๆ 1 นาที
        setInterval(updateTime, 60000);
    </script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>