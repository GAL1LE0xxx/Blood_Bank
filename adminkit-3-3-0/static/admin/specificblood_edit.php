<?php
include "../connect.php"; 
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}  
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM specificblood WHERE sb_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sbblood = $row['sb_information'];
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
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <title>แก้ไขข้อมูลโลหิตเฉพาะส่วน</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include "adminnav.php"; ?>

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
                                <a class="dropdown-item" href="adminprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-lg-8 col-xxl- d-flex">
                            <div class="card flex-fill ">
                                <div class="table-responsive">
                                    <tbody>
                                        <div class="contentdata ">
                                            <form action="specificblood_edit_db.php" method="post">
                                                <div class="card-body ">
                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ลำดับ</h5>
                                                        <input type="text" class="form-control " name="sb_id" value="<?php echo $id ?>" readonly>
                                                    </div>
                                                    <div class="form-floating">
                                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="sbblood">
                                                            <option selected>กรุณาเลือก</option>
                                                            <option value="เกล็ดเลือด">เกล็ดเลือด</option>
                                                            <option value="เม็ดเลือดแดง">เม็ดเลือดแดง</option>
                                                            <option value="พลาสม่า">พลาสม่า</option>
                                                        </select>
                                                        <label for="floatingSelect">หมู่เลือด</label>
                                                    </div>

                                                    <button type="submit" name="edit_specificblood" class="btn btn-success mt-3">แก้ไข</button>
                                                    <button type="cancel" name="cancel" class="btn btn-danger mt-3">ยกเลิก</button>
                                                </div>
                                            </form>
                                        </div>

                                    </tbody>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
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

    <script src="../js/app.js"></script>


</body>

</html>