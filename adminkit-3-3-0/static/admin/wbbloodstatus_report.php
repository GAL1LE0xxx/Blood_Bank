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
                    <h1 class="h3 mb-3"><strong>รายงานข้อมูลโลหิตรวม</strong></h1>
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
                                        <?php
                                        include('../connect.php');

                                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่
                                        if (isset($_GET['month']) && isset($_GET['year'])) {
                                            $selectedMonth = $_GET['month'];
                                            $selectedYear = $_GET['year'];

                                            // คำสั่ง SQL เริ่มต้น
                                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 0 
                      AND MONTH(wd_date) = $selectedMonth 
                      AND YEAR(wd_date) = $selectedYear";

                                            $result = mysqli_query($conn, $query);

                                            if (!$result) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            $row = mysqli_fetch_assoc($result);
                                            $canuse = $row['total'];
                                        } else {
                                            // ถ้าไม่มีการเลือกเดือนหรือปี
                                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 0";

                                            $result = mysqli_query($conn, $query);

                                            if (!$result) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            $row = mysqli_fetch_assoc($result);
                                            $canuse = $row['total'];
                                        }
                                        ?>
                                        <div class="col mt-0">
                                            <h5 class="card-title">สามารถนำไปใช้งานได้</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $canuse ?> คน </h1>
                                </div>

                            </div>
                        </div>

                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                            $selectedMonth = $_GET['month'];
                            $selectedYear = $_GET['year'];

                            // คำสั่ง SQL เริ่มต้น
                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 1 
                      AND MONTH(wd_date) = $selectedMonth 
                      AND YEAR(wd_date) = $selectedYear";
                        } else {
                            // ถ้าไม่มีการเลือกเดือนหรือปี
                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 1";
                        }

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $unable = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ไม่สามารถนำไปใช้งานได้</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $unable ?> ยูนิต </h1>
                                </div>
                            </div>
                        </div>
                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                            $selectedMonth = $_GET['month'];
                            $selectedYear = $_GET['year'];

                            // คำสั่ง SQL เริ่มต้น
                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 2 
                      AND MONTH(wd_date) = $selectedMonth 
                      AND YEAR(wd_date) = $selectedYear";
                        } else {
                            // ถ้าไม่มีการเลือกเดือนหรือปี
                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                            $query = "SELECT COUNT(*) as total FROM wholedonation WHERE wd_status = 2";
                        }

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                        }

                        $row = mysqli_fetch_array($result);
                        $use = $row[0];
                        ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">ถูกนำไปใช้งานแล้ว</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $use ?> ยูนิต </h1>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h5 class="card-title ">ตารางแสดงข้อมูลสถานะโลหิต
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
                                            <th>หมู่โลหิต</th>
                                            <th>วันที่บริจาค</th>
                                            <th>สถานะโลหิต</th>
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
                                            $sql = "SELECT wd.*, d.dn_name, d.wb_id, wb.wb_bloodtype
                                            FROM wholedonation AS wd
                                            JOIN donor AS d ON wd.dn_id = d.dn_id
                                            JOIN wholeblood AS wb ON d.wb_id = wb.wb_id
                                            WHERE MONTH(wd.wd_date) = $selectedMonth AND YEAR(wd.wd_date) = $selectedYear
                                            ORDER BY wd.wd_date DESC
                                            ";
                                        } else {
                                            $sql = "SELECT wd.*, d.dn_name, d.wb_id, wb.wb_bloodtype
                                        FROM wholedonation AS wd
                                        JOIN donor AS d ON wd.dn_id = d.dn_id
                                        JOIN wholeblood AS wb ON d.wb_id = wb.wb_id
                                        ORDER BY wd.wd_date DESC";
                                        }

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {

                                            $tid = 1; // ตัวแปรนับลำดับที่
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $tid . "</td>";
                                                echo "<td>" . $row["dn_name"] . "</td>"; // เปลี่ยน "ชื่อผู้บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                echo "<td>" . $row["wb_bloodtype"] . "</td>"; // เปลี่ยน "หมู่โลหิต" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                echo "<td>" . date("d/m/Y", strtotime($row['wd_date'])) . "</td>"; // เปลี่ยน "วันที่บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                if ($row["wd_status"] == "0") {
                                                    echo "<td><span class=\"badge bg-warning\">สามารถนำไปใช้ได้</span></td>";
                                                } elseif ($row["wd_status"] == "1") {
                                                    echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                } elseif ($row["wd_status"] == "2") {
                                                    echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                } // เปลี่ยน "สถานะโลหิต" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
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
        "canuse" => $canuse,
        "unable" => $unable,
        "use" => $use
    );

    $jsonData = json_encode($data);
    ?>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
        // ใช้ jsonData ใน JavaScript เพื่อสร้างกราฟ
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var canuse = jsonData.canuse;
            var unable = jsonData.unable;
            var use = jsonData.use;

            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ['ข้อมูลสถานะโลหิต'],
                    datasets: [{
                            label: 'สามารถนำไปใช้ได้',
                            data: [canuse],
                            backgroundColor: 'rgba(255, 255, 0, 0.2)',
                            borderColor: 'rgba(255, 255, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'ไม่สามารถนำไปใช้ได้',
                            data: [unable],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'นำไปใช้แล้ว',
                            data: [use],
                            backgroundColor: 'rgba(0, 255, 0, 0.2)',
                            borderColor: 'rgba(0, 255, 0, 1))',
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