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
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลและจำนวนผู้บริจาคโลหิต (แยกตามเพศ)</strong></h1>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        include('../connect.php');


                                        $query = "SELECT COUNT(*) AS total_donors  FROM donor ";

                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                        }

                                        $row = mysqli_fetch_assoc($result);
                                        $total_donors = $row['total_donors'];
                                        ?>
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้บริจาคทั้งหมด</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_donors ?> คน </h1>
                                </div>

                            </div>
                        </div>
                        <!-- ชาย -->
                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่

                        $query = "SELECT COUNT(*) AS total_donorsm
                            FROM donor
                            WHERE dn_gender = 0";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $total_donorsm = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้บริจาคเพศชาย </h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_donorsm ?> คน </h1>
                                </div>
                            </div>
                        </div>
                        <!-- ชาย -->


                        <!-- ญ -->
                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่

                        // ถ้าไม่มีการเลือกเดือนหรือปี
                        // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                        $query = "SELECT COUNT(*) AS total_donorsm
                            FROM donor
                            WHERE dn_gender = 1";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $total_donorsf = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้บริจาคเพศหญิง </h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $total_donorsf ?> คน </h1>
                                </div>
                            </div>
                        </div>
                        <!-- ญ -->


                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title ">ตารางแสดงข้อมูลและจำนวนผู้บริจาคโลหิต
                                    </h5>
                                </div>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover my-0 ">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อผู้บริจาค</th>
                                                <th>เพศ</th>
                                                <th>หมู่โลหิต</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            // เชื่อมต่อ database
                                            include('../connect.php');

                                            $sql = "SELECT d.*, d.dn_name, d.wb_id, wb.wb_bloodtype
                                            FROM donor AS d
                                            JOIN wholeblood AS wb ON d.wb_id = wb.wb_id";


                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {

                                                $tid = 1; // ตัวแปรนับลำดับที่
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $tid . "</td>";
                                                    echo "<td>" . $row["dn_name"] . "</td>"; // เปลี่ยน "ชื่อผู้บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                    
                                                    if ($row["dn_gender"] == "0") {
                                                        echo "<td>ชาย</td>";
                                                    } elseif ($row["dn_gender"] == "1") {
                                                        echo "<td>หญิง</td>";
                                                    } else {
                                                        echo "<td>Unknown</td>";
                                                    } // เปลี่ยน "ชื่อผู้บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                    echo "<td>" . $row["wb_bloodtype"] . "</td>"; // เปลี่ยน "หมู่โลหิต" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
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

                        <div class="col-xl-6 col-xxl-12">
                            <div class="card flex-fill w-150">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">แผนภูมิแท่งแสดงข้อมูลสถานะโลหิต
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({

            });
        });
    </script>

    <?php
    $data = array(
        "total_donorsm" => $total_donorsm,
        "total_donorsf" => $total_donorsf,
    );

    $jsonData = json_encode($data);
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
        // ใช้ jsonData ใน JavaScript เพื่อสร้างกราฟ
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var total_donorsm = jsonData.total_donorsm;
            var total_donorsf = jsonData.total_donorsf;

            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ['จำนวนผู้บริจาค'],
                    datasets: [{
                            label: 'จำนวนผู้บริจาคโลหิตเพศชาย',
                            data: [total_donorsm],
                            backgroundColor: 'rgba(255, 255, 0, 0.2)',
                            borderColor: 'rgba(255, 255, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'จำนวนผู้บริจาคโลหิตเพศหญิง',
                            data: [total_donorsf],
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