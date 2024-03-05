<?php

include('camera/search_camera.php');
include('building/search_building.php');


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
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-building me-2"></i>BUILDING</a>
                    <a href="camera.php" class="nav-item nav-link "><i class="fa fa-camera me-2"></i>CAMERA</a>
                    <a href="classroom.php" class="nav-item nav-link "><i
                            class="fa fa-graduation-cap me-2"></i>CLASSROOM</a>
                            <a href="subject.php" class="nav-item nav-link "><i
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
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">เพิ่มอาคาร</h6>
                            <form action="building/add_building.php" method="post">
                                <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="ตัวย่ออาคาร เช่น EL"
                                        name="name" autocomplete="off" required>
                                    <span class="input-group-text">-</span>
                                    <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="building_name"
                                        autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">เพิ่มห้อง</h6>
                            <form action="building/add_room.php" method="post" onsubmit="return validateForm2();">
                                <!-- เพิ่ม form tag และกำหนด action ไปที่ไฟล์ process.php -->
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="building" id=""
                                        aria-label="Floating label select example">
                                        <option value="null" selected>อาคาร</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($building2_result)) {
                                            echo ' <option value="' . $row['name'] . '">' . $row['name'] . ' - ' . $row['building_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="building">อาคาร</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="เลขห้อง เช่น 101"
                                        name="room_number" autocomplete="off" required>
                                    <span class="input-group-text">-</span>
                                    <input type="text" class="form-control" placeholder="ชื่อห้อง" name="room_name"
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
                        <h6 class="mb-0">ห้อง</h6>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="building" id="building"
                            aria-label="Floating label select example">
                            <option value="null" selected>อาคาร</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($building_result)) {
                                echo ' <option value="' . $row['name'] . '">' . $row['name'] . ' - ' . $row['building_name'] . '</option>';
                            }
                            ?>
                        </select>
                        <label for="building">อาคาร</label>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">เลขห้อง</th>
                                    <th scope="col">ชื่อห้อง</th>
                                    <th scope="col" class="text-primary">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">อาคาร</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">อาคาร</th>
                                    <th scope="col" class="text-primary">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($building1_result)) {

                                    echo "<tr><td>" . $row['name'] . " - " . $row['building_name'] . "</td> ";

                                    echo "<td><a class='btn btn-sm btn-primary' href='building/del_building.php?id=" . $row['id'] . "'>ลบ</a></td> </tr>";

                                }
                                ?>
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

        document.addEventListener("DOMContentLoaded", function () {
            var buildingSelect = document.getElementById("building");
            var tableBody = $('#myTable tbody'); // เลือกตารางที่มี ID เป็น myTable และ tbody

            buildingSelect.addEventListener("change", function () {
                storeSelectedOptions();
            });


            function storeSelectedOptions() {
                var selectedOptions = {
                    building: buildingSelect.value,

                };

                processSelectedOptions(selectedOptions);
            }

            function processSelectedOptions(selectedOptions) {
                if (selectedOptions.building != "null") {
                    $.ajax({
                        url: 'building/search_room.php',
                        type: 'GET',
                        data: { term: selectedOptions.building },
                        dataType: 'json',
                        success: function (data) {
                            var dataArray = Object.keys(data).map(function (key) {
                                return data[key];
                            });
                            populateTable(dataArray);
                        }
                    });
                } else { tableBody.empty(); }
            }
            function populateTable(dataArray) {


                tableBody.empty(); // เคลียร์ข้อมูลในตารางก่อนเพิ่มข้อมูลใหม่
                dataArray.forEach(function (item) {
                    var roomNumber = item.room_number;
                    var roomName = item.name;
                    var roomID = item.id;
                    var tableRow = $('<tr></tr>');
                    tableRow.append($('<td></td>').text(roomNumber));
                    tableRow.append($('<td></td>').text(roomName));
                    var deleteLink = $("<a></a>").addClass('btn btn-sm btn-primary').attr('href', 'building/del_room.php?id=' + roomID).text('ลบ');
                    var deleteCell = $("<td></td>").append(deleteLink);
                    tableRow.append(deleteCell); // เพิ่มลิงก์หรือปุ่มลบตามต้องการ
                    tableBody.append(tableRow);
                });
            }
        });
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