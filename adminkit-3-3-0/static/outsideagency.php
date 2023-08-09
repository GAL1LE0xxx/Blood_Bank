<?php
include "connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยงานภายนอก</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

</head>


<body>
    <div class="wrapper">

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="home.php">
                    <img width="60" height="60" src="img\photos\logo.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>
                <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="outsideprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul> 
            </nav>

            <div class="container overflow-hidden mt-5 ">
                <div class="row gx-5">
                    <div class="col">
                        <form class="form-control" action="oabooking_db.php" method="post">
                            <div class="mt-2">
                                <h3>กรอกข้อมูลการจองคิว</h3>
                            </div>
                            <div class="mb-3 mt-3">
                                <label class="form-label">สถานที่ :</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="สถานที่ที่ต้องการให้ตั้งหน่วยบริจาค">
                            </div>

                            <div class="mb-3 ">
                                <label class="form-label">จำนวนผู้บริจาค :</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="จำนวนผู้บริจาค">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">วันที่ต้องการจอง :</label>
                                <input class="form-control form-control-lg" type="date" name="birthdate" placeholder="" />
                            </div>

                            <div class="row mb-5">

                                <div class="col">
                                    <label class="form-label">ตั้งแต่ :</label>
                                    <input type="time" class="form-control" placeholder="First name" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label class="form-label">ถึง :</label>
                                    <input type="time" class="form-control" placeholder="Last name" aria-label="Last name">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="oabooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                            </div>
                        </form>
                    </div>

                    <div class="col">
                        <div id='calendar' class="p-3 border bg-light"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msg = urlParams.get('msg');

        // Check the status and display the SweetAlert message
        if (status === 'success') {
            Swal.fire({
                title: 'Success',
                text: msg,
                icon: 'success',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'outsideagency.php';
                    window.location.href = redirectURL;
                }
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error',
                text: msg,
                icon: 'error',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'outsideagency.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th', // ระบุให้ใช้ภาษาไทย
                // ปรับแต่งสไตล์ของปฏิทิน
                viewDidMount: function() {
                    calendarEl.style.backgroundColor = '#FF0000'; // เปลี่ยนสีพื้นหลังเป็นสีแดง
                }
            });
            calendar.render();
        });
    </script>


    <style>
        #calendar {
            background-color: white !important;
            /* เปลี่ยนสีพื้นหลังเป็นสีแดง */
        }
    </style>







</body>

</html>