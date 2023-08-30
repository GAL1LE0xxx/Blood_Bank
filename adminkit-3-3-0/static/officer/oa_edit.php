<?php
include "../connect.php";
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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM outsideagency WHERE oa_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['oa_username'];
    $outsidename = $row['oa_name'];
    $outsidedetails = $row['oa_details'];
    $outsideaddress = $row['oa_address'];
    $coname = $row['oa_coname'];
    $cophone = $row['oa_cophone'];
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
    <title>จัดการข้อมูลการสมัครสมาชิก</title>

    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

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
                                    <div class="contentdata ">
                                        <div class="m-sm-4">
                                            <form action="oa_edit_db.php" method="post">
                                                <div class="mb-3">
                                                    <h5 class="card-title mb-3">ลำดับ</h5>
                                                    <input type="text" class="form-control " name="oa_id" value="<?php echo $id ?>" readonly>
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="text mb-1" for="username">ชื่อผู้ใช้</label>
                                                        <input class="form-control" name="username" type="text" value="<?php echo $username ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text mb-1" for="outsidename">ชื่อหน่วยงาน</label>
                                                        <input class="form-control" name="outsidename" type="text" value="<?php echo $outsidename ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <h5 class="card-title mb-3">รายละเอียดหน่วยงาน</h5>
                                                    <textarea class="form-control" rows="3" name="outsidedetails"><?php echo $outsidedetails ?></textarea>
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">ที่อยู่หน่วยงาน</label>
                                                    <input type="text" class="form-control " name="outsideaddress" value="<?php echo $outsideaddress ?>" />
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="text mb-1" for="coname">ชื่อผู้ติดต่อ</label>
                                                        <input class="form-control" name="coname" type="text" value="<?php echo $coname ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text mb-1" for="cophone">เบอร์โทรศัพท์ผู้ติดต่อ</label>
                                                        <input class="form-control" name="cophone" type="text" value="<?php echo $cophone ?>">
                                                    </div>

                                                </div>
                                                <button type="submit" class='btn btn-success' name="edit_oa">ยืนยัน</button>
                                                <td><a class='btn btn-danger' href='member.php'>ย้อนกลับ</a></td>
                                            </form>

                                        </div>

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
                    const redirectURL = 'member.php';
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
                    const redirectURL = 'oa_edit.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>

</html>