<?php
session_start();
if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: ../login.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$position = $_SESSION['position'];
if ($position != '0') {
    echo '<script>alert("สำหรับผู้ดูแลระบบเท่านั้น");window.location="../home.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>เพิ่มข้อมูลเจ้าหน้าที่</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include "adminnav.php";?>

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
                                <a class="dropdown-item" href="adminprofile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
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
                                            <h1 class="h3 mb-3 text"><strong>เพิ่มข้อมูลเจ้าหน้าที่</strong> </h1>
                                            <form action="officer_add_db.php" method="post">
                                                <div class="card-body ">
                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ชื่อผู้ใช้</h5>
                                                        <input type="text" class="form-control " name="oc_username" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">รหัสผ่าน</h5>
                                                        <input type="password" class="form-control " name="oc_password" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ยืนยันรหัสผ่าน</h5>
                                                        <input type="password" class="form-control " name="oc_password2" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ชื่อ</h5>
                                                        <input type="text" class="form-control " name="oc_firstname" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">สกุล</h5>
                                                        <input type="text" class="form-control " name="oc_lastname" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">เบอร์โทรศัพท์</h5>
                                                        <input type="text" class="form-control " name="oc_phonenumber" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ตำแหน่ง</h5>
                                                        <label class="form-check">
                                                            <input class="form-check-input" type="radio" id="admin" name="oc_position" value="0" required>
                                                            <span class="form-check-label">
                                                                แอดมิน
                                                            </span>
                                                        </label>

                                                        <label class="form-check">
                                                            <input class="form-check-input" type="radio" id="mt" name="oc_position" value="1"> <span class="form-check-label">
                                                                นักเทคนิคการแพทย์
                                                            </span>
                                                        </label>

                                                    </div>

                                                    <button type="submit" class='btn btn-success' name="add_officer">ยืนยัน</button>
                                                    <td><a class='btn btn-danger' href='officer.php'>ย้อนกลับ</a></td>

                                            </form>


                                        </div>


                                </div>
                                </tbody>

                                </table>
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
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>โรงพยาบาลตรัง</strong></a>
                                &copy;
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

    <script src="js/app.js"></script>
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
                    const redirectURL = 'officer.php';
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
                    const redirectURL = 'officer_add.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
    
    
    
    
   
</body>

</html>