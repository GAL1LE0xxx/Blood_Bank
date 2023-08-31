<?php
include "../connect.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้บริจาค</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
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
        .square-btn {
            width: 200px;
            height: 200px;
            border-radius: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .square-icon {
            font-size: 6rem;
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
                <div class="container text-center">
                    <h1 class="text-center text-light bg-danger rounded-3 mb-4">เมนู</h1>
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-center ">
                                    <a href="../home.php" class="btn btn btn-outline-danger btn-lg btn-block square-btn">
                                        <i class="fas fa-home square-icon"></i> 
                                        <span class="mt-3" style="font-size: larger;">หน้าหลัก</span>
                                    </a>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <a href="donorprofile.php" class="btn btn-outline-danger btn-lg btn-block square-btn">
                                        <i class="fas fa-solid fa-user square-icon"></i>
                                        <span class="mt-3" style="font-size: larger;">บัญชีผู้ใช้</span>
                                    </a>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <a href="donor.php" class="btn btn-outline-danger btn-lg btn-block square-btn">
                                        <i class="fas fa-solid fa-droplet square-icon"></i>
                                        <span class="mt-3" style="font-size: larger;">บริจาคโลหิต</span>
                                    </a>
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <a href="h_donate.php" class="btn btn-outline-danger btn-lg btn-block square-btn">
                                        <i class="fas fa-history square-icon"></i>
                                        <span class="mt-3" style="font-size: larger;">ประวัติการบริจาค</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <footer class="footer bg-danger text-white">
        <div class="container-fluid">
            <div class="row text-white">
                <div class="col-sm-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0">
                        <a class="text-white" href="home.php" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-white" href="home.php" target="_blank"><strong>โรงพยาบาลตรัง</strong></a>
                        &copy;
                    </p>
                </div>
                <div class="col-sm-12 col-md-6 text-center text-md-end">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Support</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Help Center</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Privacy</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Terms</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
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
                    const redirectURL = 'donormenu.php';
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
                    const redirectURL = 'donormenu.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
</body>

</html>