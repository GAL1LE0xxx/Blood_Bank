<?php
include('../connect.php');
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: donorsign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$id = $_SESSION['id'];
$username = $_SESSION['username'];

// แก้ไข SQL query ให้ถูกต้อง
$sql = "SELECT * FROM `donor` WHERE dn_id = '$id'";
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานการจองคิวของผู้บริจาคโลหิต</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="home.php">
                    <img width="60" height="60" src="../img\photos\logo.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="donorprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>รายงานการจองคิวของผู้บริจาค</strong></h1>
                    <a class="btn btn-danger mb-3" href="donormenu.php">ย้อนกลับ</a>
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
                                            <button type="submit" name="submit" class="btn btn-danger">ค้นหา</button>
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
                                            $query = "SELECT COUNT(*) as total FROM onsiteservice 
                      WHERE MONTH(on_date) = $selectedMonth 
                      AND YEAR(on_date) = $selectedYear";

                                            $result = mysqli_query($conn, $query);

                                            if (!$result) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            $row = mysqli_fetch_assoc($result);
                                            $count = $row['total'];
                                        } else {
                                            // ถ้าไม่มีการเลือกเดือนหรือปี
                                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                                            $query = "SELECT COUNT(*) as total FROM onsiteservice";

                                            $result = mysqli_query($conn, $query);

                                            if (!$result) {
                                                die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                            }

                                            $row = mysqli_fetch_assoc($result);
                                            $count = $row['total'];
                                        }
                                        ?>
                                        <div class="col mt-0">
                                            <h5 class="card-title">จำนวนผู้จองคิวทั้งหมด</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $count ?> คน </h1>
                                </div>

                            </div>
                        </div>

                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                            $selectedMonth = $_GET['month'];
                            $selectedYear = $_GET['year'];

                            // คำสั่ง SQL เริ่มต้น
                            $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงเช้า' 
              AND MONTH(on_date) = $selectedMonth 
              AND YEAR(on_date) = $selectedYear";
                        } else {
                            // ถ้าไม่มีการเลือกเดือนหรือปี
                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                            $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงเช้า'";
                        }

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
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?php echo $morning ?> คน </h1>
                                </div>
                            </div>
                        </div>
                        <?php
                        // ตรวจสอบว่ามีการเลือกเดือนและปีหรือไม่
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                            $selectedMonth = $_GET['month'];
                            $selectedYear = $_GET['year'];

                            // คำสั่ง SQL เริ่มต้น
                            $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงบ่าย' 
              AND MONTH(on_date) = $selectedMonth 
              AND YEAR(on_date) = $selectedYear";
                        } else {
                            // ถ้าไม่มีการเลือกเดือนหรือปี
                            // ให้ดึงข้อมูลทั้งหมดโดยไม่มีเงื่อนไข
                            $query = "SELECT COUNT(*) FROM onsiteservice WHERE on_time = 'ช่วงบ่าย'";
                        }

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
                                            <div class="stat text-danger">
                                                <i class="bi bi-person-fill"></i>
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
                                <h5 class="card-title mb-0">แผนภูมิแท่งแสดงจำนวนการจองคิวของผู้บริจาคในแต่ละช่วงเวลา
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

            <script src="../js/app.js"></script>
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <?php
            $data = array(
                "morning" => $morning,
                "afternoon" => $affternoon
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