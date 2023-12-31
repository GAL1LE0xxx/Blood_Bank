<?php
session_start();
if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: ../login.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$position = $_SESSION['position'];
if ($position != '1') {
    echo '<script>alert("สำหรับเจ้าหน้าที่เท่านั้น");window.location="../home.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>จัดการข้อมูลการบริจาคเฉพาะส่วน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include "tmednav.php"; ?>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="tmedprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                </div>
            </nav>

            <main class="content">
                <!--เพิ่มข้อมูลผู้ใช้-->
                <div class="container-fluid p-0">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-lg-8 col-xxl- d-flex">
                            <div class="card flex-fill ">
                                <div class="table-responsive">
                                    <tbody>
                                        <div class="contentdata ">
                                            <div class="m-sm-4">
                                                <h1 class="h3 mb-3 text"><strong>เพิ่มข้อมูลการบริจาคโลหิตเฉพาะส่วน</strong> </h1>
                                            </div>
                                            <div class="m-sm-4">
                                                <form action="sdonate_add_db.php" method="post">
                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="text mb-1" for="donorid">รหัสผู้บริจาค</label>
                                                            <input class="form-control" name="donorid" type="text" placeholder="กรุณากรอกรหัสผู้บริจาค" onblur="fetchUserInfo()" required>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <label class="text mb-1" for="user-info">ชื่อผู้บริจาค</label>
                                                            <input class="form-control" name="user-info" id="user-info" readonly>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label class="text mb-1" for="donateday">วันที่บริจาค</label>
                                                            <input class="form-control" name="donateday" type="date" required>
                                                        </div>
                                                    </div>
                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="text mb-1" for="blood-type">ประเภทโลหิตเฉพาะส่วน</label>
                                                            <select class="form-select" name="blood-type" id="blood-type" required>
                                                                <option selected>โปรดเลือกโลหิตเฉพาะส่วน</option>
                                                                <option value="1">เกล็ดเลือด</option>
                                                                <option value="2">เม็ดเลือดแดง</option>
                                                                <option value="3">พลาสม่า</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text mb-1" for="amount">ปริมาณโลหิต (มิลลิลิตร):</label>
                                                            <input class="form-control" name="amount" type="text" placeholder="กรุณากรอกบริมาณโลหิต" id="amount" disabled>
                                                        </div>
                                                    </div>



                                                    <button type="submit" class='btn btn-success' name="add_sdonate">ยืนยัน</button>
                                                    <td><a class='btn btn-danger' href='blooddonate.php'>ย้อนกลับ</a></td>
                                                </form>
                                            </div>
                                        </div>
                                    </tbody>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--จบเพิ่มข้อมูลผู้ใช้-->
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>โรงพยาบาลตรัง</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="../js/app.js"></script>
    <script>
        function fetchUserInfo() {
            // ดึงค่ารหัสผู้บริจาคที่ผู้ใช้ป้อน
            var donorid = document.getElementsByName('donorid')[0].value;

            // ส่งคำร้องขอ AJAX ไปยังไฟล์ PHP ที่จะดึงข้อมูลผู้ใช้
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_useroa_info.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // แสดงข้อมูลผู้ใช้ที่ได้รับจากเซิร์ฟเวอร์
                    document.getElementById('user-info').value = xhr.responseText; // เปลี่ยน user-info.name เป็น xhr.responseText
                }
            };
            xhr.send("donorid=" + donorid);
        }
    </script>
    <script>
        var bloodTypeSelect = document.getElementById('blood-type');
        var amountInput = document.getElementById('amount');

        bloodTypeSelect.addEventListener('change', function() {
            // เมื่อผู้ใช้เลือกประเภทโลหิต
            if (bloodTypeSelect.value !== 'โปรดเลือกโลหิตเฉพาะส่วน') {
                // ถ้าไม่เท่ากับโปรดเลือกโลหิตเฉพาะส่วน
                // เปิดใช้งานฟิลด์ให้ผู้ใช้กรอกค่า
                amountInput.disabled = false;
            } else {
                // ถ้าเลือกโปรดเลือกโลหิตเฉพาะส่วน
                // ปิดใช้งานฟิลด์และเคลียร์ค่า
                amountInput.disabled = true;
                amountInput.value = '';
            }
        });
    </script>
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
                    const redirectURL = 'blooddonate.php';
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
                    const redirectURL = 'sdonate_add.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>

</html>