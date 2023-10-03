<?php
session_start();
include "../connect.php";
if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้บริจาค</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
    <!-- <link href="style.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ใช้ CSS เพื่อเปลี่ยนสีปุ่มเป็นสีแดง */
        #back-button {
            background-color: #dc3545;
            color: white;
        }

        .nav-pills .nav-link.active {
            background-color: #dc3545;
            color: white;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="../home.php">
                    <img width="60" height="60" src="../img\photos\logo.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="donorprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <main class="content">
                <div class="container overflow-hidden ">
                    <ul class="nav nav-pills " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active  " id="back-button" onclick="window.history.back()" type="button">ย้อนกลับ</button>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <ul class="nav nav-pills mt-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="onbooking-tab" data-bs-toggle="tab" data-bs-target="#onbooking" type="button" role="tab" aria-controls="onbooking" aria-selected="true">จองคิว</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="onbookingcheck-tab" data-bs-toggle="tab" data-bs-target="#onbookingcheck" type="button" role="tab" aria-controls="onbookingcheck" aria-selected="false">ตรวจสอบการจองคิว</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="onbooking" role="tabpanel" aria-labelledby="donor-tab">
                            <div class="container-fluid p-0">
                                <div class="row gx-5">
                                    <div class="col">
                                        <form class="form-control" action="onbooking_db.php" method="post">
                                            <div class="mt-2">
                                                <h3>กรอกข้อมูลการจองคิว</h3>
                                            </div>
                                            <input type="hidden" class="form-control form-control-lg" id="id" name="id" value="<?php echo $id ?>">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">วันที่ต้องการจอง :</label>
                                                    <input class="form-control form-control-lg" type="date" name="bookingdate" placeholder="" required min="<?php echo date('Y-m-d', strtotime('+1 month')); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="bookingtime">เวลา :</label>
                                                    <input class="form-control form-control-lg" type="time" name="bookingtime" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="onbooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="onbookingcheck" role="tabpanel" aria-labelledby="onbookingcheck-tab">
                            <div class="container-fluid p-0">
                                <div class="mt-4">
                                    <form class="form-control" action="oabooking_db.php" method="post">
                                        <div class="mt-2">
                                            <h3>ตรวจสอบข้อมูลการจองคิว</h3>
                                        </div>
                                        <input type="hidden" class="form-control form-control-lg" id="id" name="id" value="<?php echo $id ?>">
                                        <div class="row gx-3 mb-3">
                                            <label class="form-label">วันที่ :</label>
                                            <input class="form-control form-control-lg" type="date" name="bookingdate" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="oabooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
        
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
                        const redirectURL = 'donor.php';
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
                        const redirectURL = 'donor.php';
                        window.location.href = redirectURL;
                    }
                });
            }
        </script>

</body>


</html>