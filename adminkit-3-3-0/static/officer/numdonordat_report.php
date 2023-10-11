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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>รายงานข้อมูลและจำนวนผู้บริจาคโลหิต</title>
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
        <?php include "tmednav.php"; ?>

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
                                <a class="dropdown-item" href="tmedprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">

                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลและจำนวนผู้บริจาคโลหิต (แยกตามจำนวนครั้งของการบริจาค)</strong></h1>
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="month">เดือน:</label>
                                            <select name="month" id="month" class="form-control">
                                                <!-- สร้างตัวเลือกเดือนที่คุณต้องการให้ผู้ใช้เลือก -->
                                                <option selected disabled>กรุณาเลือกเดือน</option>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฎาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="year">ปี:</label>
                                            <select name="year" id="year" class="form-control">
                                                <option selected disabled>กรุณาเลือกปี</option>
                                                <?php
                                                // สร้างตัวเลือกปีจากปีปัจจุบันถึง 10 ปีถัดไป
                                                $currentYear = date("Y");
                                                for ($i = $currentYear; $i <= $currentYear + 10; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
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
                                <h5 class="card-title ">ตารางแสดงข้อมูลและจำนวนผู้บริจาคโลหิต
                                    <?php
                                    if (isset($_GET['month']) && isset($_GET['year'])) {
                                        $selectedMonth = $_GET['month'];
                                        $selectedYear = $_GET['year'];

                                        // แปลงเดือนเป็นเดือนไทย
                                        $thaiMonths = array(
                                            '1' => 'มกราคม',
                                            '2' => 'กุมภาพันธ์',
                                            '3' => 'มีนาคม',
                                            '4' => 'เมษายน',
                                            '5' => 'พฤษภาคม',
                                            '6' => 'มิถุนายน',
                                            '7' => 'กรกฎาคม',
                                            '8' => 'สิงหาคม',
                                            '9' => 'กันยายน',
                                            '10' => 'ตุลาคม',
                                            '11' => 'พฤศจิกายน',
                                            '12' => 'ธันวาคม'
                                        );
                                        $thaiMonth = $thaiMonths[$selectedMonth];

                                        // แปลงปีเป็นปีไทย
                                        $thaiYear = $selectedYear + 543;

                                        echo " เดือน $thaiMonth ปี $thaiYear";
                                    }
                                    ?></h5>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover my-0 ">
                                    <thead>
                                        <tr>
                                            <th>ลำดับที่</th>
                                            <th>ชื่อผู้บริจาค</th>
                                            <th>วันที่บริจาคครั้งล่าสุด</th>
                                            <th>หมู่โลหิต</th>
                                            <th>จำนวนครั้งที่บริจาค</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // เชื่อมต่อ database
                                        include('../connect.php');

                                        if (isset($_GET['month']) && isset($_GET['year'])) {
                                            $selectedMonth = $_GET['month'];
                                            $selectedYear = $_GET['year'];

                                            // ดึงข้อมูลจาก database
                                            $sql = "SELECT donor.dn_name, COUNT(wholedonation.dn_id) AS num,
                   MAX(wholedonation.wd_date) AS วันที่ล่าสุดบริจาค,
                   wholeblood.wb_bloodtype AS หมู่เลือด
            FROM wholedonation
            INNER JOIN donor ON wholedonation.dn_id = donor.dn_id
            INNER JOIN wholeblood ON donor.wb_id = wholeblood.wb_id
            WHERE MONTH(wholedonation.wd_date) = $selectedMonth AND YEAR(wholedonation.wd_date) = $selectedYear
            GROUP BY donor.dn_name
            ORDER BY MAX(wholedonation.wd_date) DESC";
                                        } else {
                                            $sql = "SELECT
                                            donor.dn_name,
                                            COUNT(wholedonation.dn_id) AS num,
                                            MAX(wholedonation.wd_date) AS วันที่ล่าสุดบริจาค,
                                            wholeblood.wb_bloodtype AS หมู่เลือด
                                        FROM wholedonation
                                        INNER JOIN donor ON wholedonation.dn_id = donor.dn_id
                                        INNER JOIN wholeblood ON donor.wb_id = wholeblood.wb_id
                                        GROUP BY donor.dn_name";
                                        }

                                        $result = mysqli_query($conn, $sql); // ย้ายการเรียกคำสั่ง SQL ไปในส่วนนี้

                                        if (mysqli_num_rows($result) > 0) {

                                            $tid = 1; // ตัวแปรนับลำดับที่
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $tid . "</td>";
                                                echo "<td>" . $row["dn_name"] . "</td>";
                                                echo "<td>" . date("d/m/Y", strtotime($row['วันที่ล่าสุดบริจาค'])) . "</td>";
                                                echo "<td>" . $row["หมู่เลือด"] . "</td>";
                                                echo "<td>" . $row["num"] . "</td>";
                                                echo "</tr>";
                                                $tid++;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // ปิดการเชื่อมต่อ database
                                        mysqli_close($conn);
                                        ?>


                                    </tbody>
                                </table>
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