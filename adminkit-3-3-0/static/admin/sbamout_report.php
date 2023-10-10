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
    <title>รายงานปริมาณโลหิต</title>
    <link href="../css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
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
                    <!-- แสดงปริมาณเลือดทั้งหมด -->
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลปริมาณโลหิตเฉพาะส่วน</strong></h1>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        include('../connect.php');

                                        $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd_amount 
                                        FROM specificdonation sd 
                                        INNER JOIN specificblood sb 
                                        ON sd.sb_id = sb.sb_id GROUP BY sd.sb_id";

                                        $result = mysqli_query($conn, $query);

                                        if ($result === false) {
                                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                        }

                                        $total_sd_amount = 0; // เริ่มต้นค่า total_wd_amount เป็น 0
                                        $count = 0; // เริ่มต้นค่า count เป็น 0

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $total_sd_amount += $row['total_sd_amount'];
                                            $count++;
                                        }
                                        ?>

                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณโลหิตเฉพาะส่วนทั้งหมด</h5>
                                        </div>

                                        <div class="col-auto ">
                                            <div class="stat text-danger">
                                                <i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_sd_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดทั้งหมด -->

                        <!-- แสดงปริมาณเลือดหมู่ A -->
                        <?php
                        $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd1_amount 
                        FROM specificdonation sd 
                        INNER JOIN specificblood sb ON sd.sb_id = sb.sb_id 
                        WHERE sb.sb_id = 1
                        GROUP BY sd.sb_id";

                        $result = mysqli_query($conn, $query);
                        if ($result === false) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $total_sd1_amount = 0; // เริ่มต้นค่า total_wd_amount เป็น 0
                        $count = 0; // เริ่มต้นค่า count เป็น 0

                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_sd1_amount += $row['total_sd1_amount'];
                            $count++;
                        }
                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณพลาสม่า</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_sd1_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>

                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ A -->

                        <!-- แสดงปริมาณเลือดหมู่ B -->
                        <?php
                        $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd2_amount 
                        FROM specificdonation sd 
                        INNER JOIN specificblood sb ON sd.sb_id = sb.sb_id 
                        WHERE sb.sb_id = 2 
                        GROUP BY sd.sb_id";

                        $result = mysqli_query($conn, $query);
                        if ($result === false) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $total_sd2_amount = 0; // เริ่มต้นค่า total_wd_amount เป็น 0
                        $count = 0; // เริ่มต้นค่า count เป็น 0

                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_sd2_amount += $row['total_sd2_amount'];
                            $count++;
                        }
                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณเม็ดเลือดแดง</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_sd2_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ B -->

                        <!-- แสดงปริมาณเลือดหมู่ O -->
                        <?php
                        $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd3_amount 
                        FROM specificdonation sd 
                        INNER JOIN specificblood sb ON sd.sb_id = sb.sb_id 
                        WHERE sb.sb_id = 3
                        GROUP BY sd.sb_id";

                        $result = mysqli_query($conn, $query);
                        if ($result === false) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $total_sd3_amount = 0; // เริ่มต้นค่า total_wd_amount เป็น 0
                        $count = 0; // เริ่มต้นค่า count เป็น 0

                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_sd3_amount += $row['total_sd3_amount'];
                            $count++;
                        }
                        ?>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ปริมาณเกล็ดเลือด</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-droplet-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_sd3_amount ?> มิลลิลิตร </h1>
                                </div>
                            </div>
                        </div>
                        <!-- แสดงปริมาณเลือดหมู่ O -->



                        <div class="col-xl-6 col-xxl-12">
                            <div class="card flex-fill w-150">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">แผนภูมิแท่งแสดงปริมาณโลหิตเฉพาะส่วนแยกตามประเภท
                                    </h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
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
        "sd1" => $total_sd1_amount,
        "sd2" => $total_sd2_amount,
        "sd3" => $total_sd3_amount,
    );

    $jsonData = json_encode($data);
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
        // ใช้ jsonData ใน JavaScript เพื่อสร้างกราฟ
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sd1 = jsonData.sd1;
            var sd2 = jsonData.sd2;
            var sd3 = jsonData.sd3;

            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ['ปริมาณโลหิตเฉพาะส่วน'],
                    datasets: [{
                            label: 'พลาสม่า',
                            data: [sd1],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // สีพื้นหลัง
                            borderColor: 'rgba(75, 192, 192, 1)', // สีเส้นขอบ
                            borderWidth: 1
                        },
                        {
                            label: 'เม็ดเลือดแดง',
                            data: [sd2],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'เกล็ดเลือด',
                            data: [sd3],
                            backgroundColor: 'rgba(255, 205, 86, 0.2)', // สีพื้นหลัง
                            borderColor: 'rgba(255, 205, 86, 1)', // สีเส้นขอบ
                            borderWidth: 1
                        }
                        
                    ]

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