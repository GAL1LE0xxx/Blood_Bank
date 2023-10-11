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
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>รายงานข้อมูลโลหิตรวม</title>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



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
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="../adminprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">

                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลและจำนวนผู้บริจาคโลหิต (ตามช่วงอายุ)</strong></h1>
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="min_age">อายุต่ำสุด:</label>
                                            <input type="text" name="min_age" id="min_age" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="max_age">อายุสูงสุด:</label>
                                            <input type="text" name="max_age" id="max_age" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary">ค้นหา</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h5 class="card-title">รายงานข้อมูลและจำนวนผู้บริจาคโลหิต (ตามช่วงอายุ)
                                    <?php
                                    include('../connect.php');

                                    // ตรวจสอบว่ามีการระบุ 'min_age' และ 'max_age' ใน $_GET
                                    if (isset($_GET['min_age']) && isset($_GET['max_age'])) {
                                        $min_age = mysqli_real_escape_string($conn, $_GET['min_age']);
                                        $max_age = mysqli_real_escape_string($conn, $_GET['max_age']);
                                        $age_filter = "WHERE YEAR(CURDATE()) - YEAR(dn_birthdate) BETWEEN $min_age AND $max_age";
                                    } else {
                                        $min_age = 0; // กำหนดค่าอายุขั้นต่ำเป็น 0 (ไม่มีข้อจำกัด)
                                        $max_age = 999; // กำหนดค่าอายุสูงสุดเป็น 999 (หรือค่าที่มากกว่า)
                                        $age_filter = ""; // ไม่มีการกรองตามอายุ
                                    }

                                    $sql = "SELECT dn_name, DATE_FORMAT(dn_birthdate, '%Y-%m-%d') AS birthdate, YEAR(CURDATE()) - YEAR(dn_birthdate) AS age
        FROM donor
        $age_filter";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2>ผู้บริจาคทั้งหมด:</h2>";
                                            echo "<div class='table-responsive'>";
                                            echo "<table id='myTable' class='table table-hover my-0'>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<th>ลำดับที่</th>";
                                            echo "<th>ชื่อผู้บริจาค</th>";
                                            echo "<th>วันเกิด</th>";
                                            echo "<th>อายุ</th>";
                                            echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";

                                            $tid = 1; // ตัวแปรนับลำดับที่
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $tid . "</td>";
                                                echo "<td>" . $row["dn_name"] . "</td>";
                                                echo "<td>" . date("d/m/Y", strtotime($row['birthdate'])) . "</td>";
                                                echo "<td>" . $row["age"] . "</td>";
                                                echo "</tr>";
                                                $tid++;
                                            }

                                            echo "</tbody>";
                                            echo "</table>";
                                            echo "</div>";
                                        } else {
                                            echo "ไม่พบผู้บริจาคในฐานข้อมูล";
                                        }
                                    } else {
                                        die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                    }
                                    ?>

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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({

            });
        });
    </script>
</body>

</html>