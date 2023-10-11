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
    <title>รายงานปริมาณโลหิต</title>
    <link href="../css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
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
                    <!-- แสดงปริมาณเลือดทั้งหมด -->
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลปริมาณโลหิตรวม</strong></h1>
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


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- แสดงปริมาณเลือดทั้งหมด -->
                                        <?php
                                        include('../connect.php');

                                        if (isset($_GET['month']) && isset($_GET['year'])) {
                                            // ถ้าผู้ใช้เลือกเดือนและปี
                                            $month = $_GET['month'];
                                            $year = $_GET['year'];

                                            // เชื่อมต่อฐานข้อมูลและดึงข้อมูลปริมาณเลือดตามเดือนและปีที่เลือก
                                            $query = "SELECT SUM(wh.wd_amount) AS total_wd_amount
              FROM wholedonation wh
              WHERE YEAR(wh.wd_date) = $year AND MONTH(wh.wd_date) = $month";

                                            $result = mysqli_query($conn, $query);

                                            if ($result === false) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            // เริ่มต้นค่า total_wd_amount เป็น 0
                                            $total_wd_amount = 0;
                                            $count = 0;

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total_wd_amount += $row['total_wd_amount'];
                                                $count++;
                                            }
                                        } else {
                                            // ถ้าไม่มีการเลือกเดือนหรือปี
                                            // ดึงข้อมูลปริมาณเลือดทั้งหมด
                                            $query = "SELECT SUM(wh.wd_amount) AS total_wd_amount
              FROM wholedonation wh";

                                            $result = mysqli_query($conn, $query);

                                            if ($result === false) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            // เริ่มต้นค่า total_wd_amount เป็น 0
                                            $total_wd_amount = 0;
                                            $count = 0;

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total_wd_amount += $row['total_wd_amount'];
                                                $count++;
                                            }
                                        }
                                        ?>
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตรวมทั้งหมด</h5>
                                        </div>

                                        <div class="col-auto ">
                                            <div class="stat text-danger">
                                                <i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_wd_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดทั้งหมด -->


                        <!-- แสดงปริมาณเลือดหมู่ A -->
                        <?php

                        include('../connect.php');

                        $month = isset($_GET['month']) ? $_GET['month'] : null;
                        $year = isset($_GET['year']) ? $_GET['year'] : null;

                        // ถ้าผู้ใช้ไม่ได้เลือกเดือนหรือปี หรือทั้งคู่
                        if (!$month && !$year) {
                            $query = "SELECT SUM(wh.wd_amount) AS total_wd_A_amount
              FROM wholedonation wh
              INNER JOIN donor d ON wh.dn_id = d.dn_id
              INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
              WHERE wb.wb_id = 1";

                            $result = mysqli_query($conn, $query);
                            if ($result === false) {
                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                            }

                            $total_wd_A_amount = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_wd_A_amount += $row['total_wd_A_amount'];
                            }
                        } else {
                            // ถ้าผู้ใช้เลือกเดือนและ/หรือปี
                            $query = "SELECT SUM(wh.wd_amount) AS total_wd_A_amount
              FROM wholedonation wh
              INNER JOIN donor d ON wh.dn_id = d.dn_id
              INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
              WHERE wb.wb_id = 1";

                            if ($month) {
                                $query .= " AND MONTH(wh.wd_date) = $month";
                            }

                            if ($year) {
                                $query .= " AND YEAR(wh.wd_date) = $year";
                            }

                            $result = mysqli_query($conn, $query);
                            if ($result === false) {
                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                            }

                            $total_wd_A_amount = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_wd_A_amount += $row['total_wd_A_amount'];
                            }
                        }

                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตหมู่เลือด A</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                A<i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_wd_A_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ A -->

                        <!-- แสดงปริมาณเลือดหมู่ B -->
                        <?php

                        include('../connect.php');

                        $month = isset($_GET['month']) ? $_GET['month'] : null;
                        $year = isset($_GET['year']) ? $_GET['year'] : null;

                        // ถ้าผู้ใช้ไม่ได้เลือกเดือนหรือปี หรือทั้งคู่
                        if (!$month && !$year) {
                            $query = "SELECT wb.wb_id, SUM(wh.wd_amount) AS total_wd_B_amount
              FROM wholedonation wh
              INNER JOIN donor d ON wh.dn_id = d.dn_id
              INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
              WHERE wb.wb_id = 2";

                            $result = mysqli_query($conn, $query);
                            if ($result === false) {
                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                            }

                            $total_wd_B_amount = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_wd_B_amount += $row['total_wd_B_amount'];
                            }
                        } else {
                            // ถ้าผู้ใช้เลือกเดือนและ/หรือปี
                            $query = "SELECT wb.wb_id, SUM(wh.wd_amount) AS total_wd_B_amount
              FROM wholedonation wh
              INNER JOIN donor d ON wh.dn_id = d.dn_id
              INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
              WHERE wb.wb_id = 2";

                            if ($month) {
                                $query .= " AND MONTH(wh.wd_date) = $month";
                            }

                            if ($year) {
                                $query .= " AND YEAR(wh.wd_date) = $year";
                            }

                            $result = mysqli_query($conn, $query);
                            if ($result === false) {
                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                            }

                            $total_wd_B_amount = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_wd_B_amount += $row['total_wd_B_amount'];
                            }
                        }

                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตหมู่เลือด B</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                B<i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_wd_B_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>

                        <!-- แสดงปริมาณเลือดหมู่ B -->

                        <!-- แสดงปริมาณเลือดหมู่ O -->
                        <?php

                        $query = "SELECT wb.wb_id, SUM(wh.wd_amount) AS total_wd_O_amount
          FROM wholedonation wh
          INNER JOIN donor d ON wh.dn_id = d.dn_id
          INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
          WHERE wb.wb_id = 3";

                        if ($month) {
                            $query .= " AND MONTH(wh.wd_date) = $month";
                        }

                        if ($year) {
                            $query .= " AND YEAR(wh.wd_date) = $year";
                        }

                        $query .= " GROUP BY wb.wb_id";

                        $result = mysqli_query($conn, $query);
                        if ($result === false) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $total_wd_O_amount = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_wd_O_amount += $row['total_wd_O_amount'];
                        }

                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตหมู่เลือด O</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                O<i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_wd_O_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ O -->

                        <!-- แสดงปริมาณเลือดหมู่ AB -->
                        <?php

                        $query = "SELECT wb.wb_id, SUM(wh.wd_amount) AS total_wd_AB_amount
          FROM wholedonation wh
          INNER JOIN donor d ON wh.dn_id = d.dn_id
          INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
          WHERE wb.wb_id = 4";

                        if ($month) {
                            $query .= " AND MONTH(wh.wd_date) = $month";
                        }

                        if ($year) {
                            $query .= " AND YEAR(wh.wd_date) = $year";
                        }

                        $query .= " GROUP BY wb.wb_id";

                        $result = mysqli_query($conn, $query);
                        if ($result === false) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $total_wd_AB_amount = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_wd_AB_amount += $row['total_wd_AB_amount'];
                        }

                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตหมู่เลือด AB</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                AB<i class="bi bi-droplet-fill  "></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_wd_AB_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ AB -->




                        <div class="col-xl-6 col-xxl-12">
                            <div class="card flex-fill w-150">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        แผนภูมิแท่งแสดงปริมาณโลหิตรวมแยกตามประเภท
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
                                        ?>
                                    </h5>

                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <?php
    $data = array(
        "wd_a" => $total_wd_A_amount,
        "wd_b" => $total_wd_B_amount,
        "wd_o" => $total_wd_O_amount,
        "wd_ab" => $total_wd_AB_amount
    );

    $jsonData = json_encode($data);
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
        // ใช้ jsonData ใน JavaScript เพื่อสร้างกราฟ
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var wd_a = jsonData.wd_a;
            var wd_b = jsonData.wd_b;
            var wd_o = jsonData.wd_o;
            var wd_ab = jsonData.wd_ab;

            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ['หมู่เหลือด A', 'หมู่เลือด B', 'หมู่เลือด O', 'หมู่เลือด AB'],
                    datasets: [{
                        label: 'ปริมาณโลหิตรวม',
                        data: [wd_a, wd_b, wd_o, wd_ab],
                        borderColor: 'rgba(75, 192, 192, 1)', // สีเส้นขอบ
                        borderWidth: 1,
                        fill: false // ปิดการเติมพื้นหลัง
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1000
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: true
                            }
                        }]
                    }
                }
            });
        });
    </script>


</body>

</html>