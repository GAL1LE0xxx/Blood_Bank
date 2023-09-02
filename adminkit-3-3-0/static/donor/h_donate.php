<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("location: donorsign-in.php");
    exit;
}

$user = $_SESSION['username'];
$id = $_SESSION['id'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการบริจาค</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <style>
        /* เปลี่ยนสีของ nav-pills */
        .nav-pills .nav-link {
            /* เปลี่ยนสีพื้นหลังของ tab */
            color:  #dc3444;
            /* เปลี่ยนสีข้อความของ tab */
        }

        /* เปลี่ยนสีของ tab ที่ถูกเลือก */
        .nav-pills .nav-link.active {
            background-color: #dc3444;
            /* เปลี่ยนสีพื้นหลังของ tab ที่ถูกเลือก */
            color: #FFFFFF;
            /* เปลี่ยนสีข้อความของ tab ที่ถูกเลือก */
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="../home.php">
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
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <main class="content">
                <div class="container">
                    <a class="btn btn-danger mt-3 mb-3" href="donormenu.php">ย้อนกลับ</a>
                    <h1 class="text-center text-light bg-danger rounded-3 mb-4">ตรวจสอบประวัติการบริจาค</h1>
                    <div class="mb-3">
                        <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="wbblood-tab" data-bs-toggle="tab" data-bs-target="#wbblood" type="button" role="tab" aria-controls="wbblood" aria-selected="true">โลหิตรวม</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="specificblood-tab" data-bs-toggle="tab" data-bs-target="#specificblood" type="button" role="tab" aria-controls="specificblood" aria-selected="false">โลหิตเฉพาะส่วน</button>
                            </li>

                        </ul>
                    </div>
                    <!-- ประวัติการบริจาคโลหิตรวม -->
                    <div>
                        <div class="container">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="wbblood" role="tabpanel" aria-labelledby="wbblood-tab">


                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <?php
                                            $sql1 = "SELECT *
                                            FROM donor 
                                            LEFT JOIN wholedonation ON donor.dn_id = wholedonation.dn_id
                                            LEFT JOIN wholeblood ON donor.wb_id = wholeblood.wb_id
                                            WHERE donor.dn_id = '$id' 
                                            ORDER BY wholedonation.wd_date DESC";

                                            $result1 = mysqli_query($conn, $sql1);

                                            if ($row1 = mysqli_fetch_assoc($result1)) {
                                                $name = $row1['dn_name'];
                                                $date = $row1['wd_date'];
                                            }

                                            echo "<p class=''>รหัสผู้บริจาค : $id</p>";
                                            echo "<p class=''>ชื่อ-สกุล : $name </p>";
                                            echo "<p class=''>หมู่เลือด : " . $row1["wb_bloodtype"] . "</p>";
                                            echo "<p class=''>วันครบกำหนดบริจาค : " . date("d/m/Y", strtotime($date . "+3 months")) . "</p>";

                                            ?>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="text-center">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>วันที่บริจาค</th>
                                                                        <th>สถานะ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $result1 = mysqli_query($conn, $sql1);
                                                                    $tid = 1;

                                                                    if ($result1 && mysqli_num_rows($result1) > 0) {
                                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                                            echo "<tr>";
                                                                            echo "<td>" . $tid . "</td>";
                                                                            echo "<td>" . date("d/m/Y", strtotime($row1['wd_date'])) . "</td>";

                                                                            if ($row1["wd_status"] == "0") {
                                                                                echo "<td><span class=\"badge bg-warning\">ยังไม่ถูกนำไปใช้</span></td>";
                                                                            } elseif ($row1["wd_status"] == "1") {
                                                                                echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                                            } elseif ($row1["wd_status"] == "2") {
                                                                                echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                                            }
                                                                            echo "</tr>";
                                                                            $tid++;
                                                                        }
                                                                    } else {
                                                                        echo "<tr><td colspan='3'>ไม่พบข้อมูล</td></tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ประวัติการบริจาคโลหิตรวม -->

                    <!-- ประวัติการบริจาคโลหิตเฉพาะส่วน -->
                    <div>
                        <div class="container">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="specificblood" role="tabpanel" aria-labelledby="specificblood-tab">


                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <?php
                                            $sql2 = "SELECT * FROM donor 
                                            LEFT JOIN specificdonation ON donor.dn_id = specificdonation.dn_id 
                                            LEFT JOIN specificblood ON donor.sb_id = specificblood.sb_id 
                                            WHERE donor.dn_id = '$id' 
                                            ORDER BY specificdonation.sd_date DESC";

                                            $result2 = mysqli_query($conn, $sql2);
                                            if ($row2 = mysqli_fetch_assoc($result2)) {
                                                $name = $row2['dn_name'];
                                                $date = $row2['sd_date'];
                                            }

                                            echo "<p class=''>รหัสผู้บริจาค : $id</p>";
                                            echo "<p class=''>ชื่อ-สกุล : $name </p>";
                                            echo "<p class=''>วันครบกำหนดบริจาค : " . date("d/m/Y", strtotime($date . "+1 months")) . "</p>";

                                            ?>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="text-center">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>วันที่บริจาค</th>
                                                                        <th>สถานะ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $result2 = mysqli_query($conn, $sql2);
                                                                    $tid = 1;

                                                                    if ($result2 && mysqli_num_rows($result2) > 0) {
                                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                            echo "<tr>";
                                                                            echo "<td>" . $tid . "</td>";
                                                                            echo "<td>" . date("d/m/Y", strtotime($row2['sd_date'])) . "</td>";

                                                                            if ($row2["sd_status"] == "0") {
                                                                                echo "<td><span class=\"badge bg-warning\">ยังไม่ถูกนำไปใช้</span></td>";
                                                                            } elseif ($row2["sd_status"] == "1") {
                                                                                echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                                            } elseif ($row2["sd_status"] == "2") {
                                                                                echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                                            }
                                                                            echo "</tr>";
                                                                            $tid++;
                                                                        }
                                                                    } else {
                                                                        echo "<tr><td colspan='3'>ไม่พบข้อมูล</td></tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ประวัติการบริจาคโลหิตเฉพาะส่วน -->

            </main>
        </div>
    </div>
    <footer class="footer bg-danger text-white">
        <div class="container-fluid">
            <div class="row text-white">
                <div class="col-sm-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0">
                        <a class="text-white" href="../home.php" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-white" href="../home.php" target="_blank"><strong>โรงพยาบาลตรัง</strong></a>
                        &copy;
                    </p>
                </div>
                <div class="col-sm-12 col-md-6 text-center text-md-end">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Support</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Help Center</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Privacy</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white" href="https://adminkit.io/" target="_blank">Terms</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


</body>

</html>