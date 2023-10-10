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
    <title>รายงานการจองคิว</title>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
                    <h1 class="h3 mb-3"><strong>รายงานการจองคิวของผู้บริจาค</strong></h1>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        include('../connect.php');
                                        $query = "SELECT COUNT(*) FROM onsiteservice";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                        }

                                        $row = mysqli_fetch_array($result);
                                        $count = $row[0];
                                        ?>
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้จองคิวทั้งหมด</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="feather feather-activity"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $count ?> คน </h1>
                                </div>
                            </div>
                        </div>

                        <?php
                        $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงเช้า'";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $morning = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้จองคิวในช่วงเช้า</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $morning ?> คน </h1>
                                </div>
                            </div>

                        </div>
                        <?php
                        $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงบ่าย'";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $affternoon = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้จองคิวในช่วงบ่าย</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $affternoon ?> คน </h1>
                                </div>
                            </div>

                        </div>

                    </div>



                    <div class="col-xl-6 col-xxl-12">
                        <div class="card flex-fill w-150">
                            <div class="card-header">

                                <h5 class="card-title mb-0">แผนภูมิแท่งแสดงจำนวนการจองคิวของผู้บริจาคในแต่ละช่วงเวลา</h5>
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
    $queryMorning = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงเช้า'";
    $resultMorning = mysqli_query($conn, $queryMorning);
    if (!$resultMorning) {
        die("การสอบถามผิดพลาด: " . mysqli_error($conn));
    }
    $rowMorning = mysqli_fetch_array($resultMorning);
    $morningData = $rowMorning[0];

    $queryAfternoon = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงบ่าย'";
    $resultAfternoon = mysqli_query($conn, $queryAfternoon);
    if (!$resultAfternoon) {
        die("การสอบถามผิดพลาด: " . mysqli_error($conn));
    }
    $rowAfternoon = mysqli_fetch_array($resultAfternoon);
    $afternoonData = $rowAfternoon[0];

    $data = array(
        "morning" => $morningData,
        "afternoon" => $afternoonData
    );

    $jsonData = json_encode($data);
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
        // ใช้ jsonData ใน JavaScript เพื่อสร้างกราฟ
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var morningData = jsonData.morning;
            var afternoonData = jsonData.afternoon;

            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ['จำนวนผู้จองคิวในช่วงเช้าและบ่าย'],
                    datasets: [{
                            label: 'จำนวนผู้จองคิวในช่วงเช้า',
                            data: [morningData],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'จำนวนผู้จองคิวในช่วงบ่าย',
                            data: [afternoonData],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
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
                                stepSize: 10
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