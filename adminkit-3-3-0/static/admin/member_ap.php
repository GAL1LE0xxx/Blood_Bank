<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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
    <title>อนุมัติข้อมูลการสมัครสมาชิก</title>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../login.php">Log out</a>
                            </div>
                        </li>
            </nav>

            <main class="content">
                <div class="mb-3">
                    <ul class="nav nav-pills " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="donor-tab" data-bs-toggle="tab" data-bs-target="#donor" type="button" role="tab" aria-controls="donor" aria-selected="true">ผู้บริจาค</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="outsideagency-tab" data-bs-toggle="tab" data-bs-target="#outsideagency" type="button" role="tab" aria-controls="outsideagency" aria-selected="false">หน่วยงานภายนอก</button>
                        </li>

                    </ul>
                </div>

                <!-- อนุมัติข้อมูลผู้บริจาค -->
                <div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="donor" role="tabpanel" aria-labelledby="donor-tab">
                            <div class="container-fluid p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-15 col-xxl- d-flex">
                                        <div class="card flex-fill">
                                            <div class="table-responsive">
                                                <table id="myTable" class="table table-hover my-0 ">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>ชื่อ-สกุล</th>
                                                            <th>วันเกิด</th>
                                                            <th>เพศ</th>
                                                            <th>ที่อยู่</th>
                                                            <th>เบอร์โทรศัพท์</th>
                                                            <th>สถานะ</th>
                                                            <th>อนุมัติ</th>
                                                            <th>ไม่อนุมัติ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        // Include the database connection file
                                                        include('../connect.php');

                                                        // Fetch data from the database
                                                        $sql = "SELECT * FROM donor ORDER BY dn_id DESC"; // เรียงข้อมูลตาม dn_id จากมากไปน้อย
                                                        $result = mysqli_query($conn, $sql);
                                                        $tid = 1;  // เริ่มต้นค่าของตัวแปรนับลำดับ
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td>" . $tid . "</td>";
                                                                echo "<td>" . $row["dn_name"] . "</td>";
                                                                echo "<td>" . $row["dn_birthdate"] . "</td>";

                                                                if ($row["dn_gender"] == "0") {
                                                                    echo "<td>ชาย</td>";
                                                                } elseif ($row["dn_gender"] == "1") {
                                                                    echo "<td>หญิง</td>";
                                                                } else {
                                                                    echo "<td>Unknown</td>";
                                                                }
                                                                echo "<td>" . $row["dn_address"] . "</td>";
                                                                echo "<td>" . $row["dn_phonenumber"] . "</td>";
                                                                if ($row["dn_status"] == "0") {
                                                                    echo "<td><span class=\"badge bg-warning\">รออนุมัติ</span></td>";
                                                                } elseif ($row["dn_status"] == "1") {
                                                                    echo "<td><span class=\"badge bg-success\">อนุมัติ</span></td>";;
                                                                } elseif ($row["dn_status"] == "2") {
                                                                    echo "<td><span class=\"badge bg-danger\">ไม่อนุมัติ</span></td>";
                                                                }
                                                                echo "<td><a class='btn btn-success' href='status_update.php?id=" . $row["dn_id"] .  "'><i class='bi bi-check-circle'></i></a></td>";
                                                                echo "<td><a class='btn btn-danger' href='status_update.php?did=" . $row["dn_id"] . "'><i class='bi bi-x-circle'></i></a></td>";
                                                                echo "</tr>";
                                                                $tid++;
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                        }

                                                        // Close the database connection
                                                        mysqli_close($conn);
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
                <!-- จบอนุมัติข้อมูลผู้บริจาค -->

                <!-- อนุมัติข้อมูลผู้หน่วยงานภายนอก -->
                <div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="outsideagency" role="tabpanel" aria-labelledby="outsideagency-tab">
                            <div class="container-fluid p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-15 col-xxl- d-flex">
                                        <div class="card flex-fill">
                                            <div class="table-responsive">
                                                <table id="myTable2" class="table table-hover my-0 ">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>ชื่อหน่วยงาน</th>
                                                            <th>ที่อยู่หน่วยงาน</th>
                                                            <th>ชื่อผู้ประสานงาน</th>
                                                            <th>เบอร์โทรศัพท์ผู้ประสานงาน</th>
                                                            <th>สถานะ</th>
                                                            <th>อนุมัติ</th>
                                                            <th>ไม่อนุมัติ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        // Include the database connection file
                                                        include('../connect.php');

                                                        $sql = "SELECT * FROM outsideagency ORDER BY oa_id DESC"; // เรียงข้อมูลตาม dn_id จากมากไปน้อย
                                                        $result = mysqli_query($conn, $sql);

                                                        $tid = 1;  // เริ่มต้นค่าของตัวแปรนับลำดับ

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td>" . $tid . "</td>";
                                                                echo "<td>" . $row["oa_name"] . "</td>";
                                                                echo "<td>" . $row["oa_address"] . "</td>";
                                                                echo "<td>" . $row["oa_coname"] . "</td>";
                                                                echo "<td>" . $row["oa_cophone"] . "</td>";
                                                                if ($row["oa_status"] == "0") {
                                                                    echo "<td><span class=\"badge bg-warning\">รออนุมัติ</span></td>";
                                                                } elseif ($row["oa_status"] == "1") {
                                                                    echo "<td><span class=\"badge bg-success\">อนุมัติ</span></td>";;
                                                                } elseif ($row["oa_status"] == "2") {
                                                                    echo "<td><span class=\"badge bg-danger\">ไม่อนุมัติ</span></td>";
                                                                }

                                                                echo "<td><a class='btn btn-success' href='oastatus_update.php?id=" . $row["oa_id"] .  "'><i class='bi bi-check-circle'></i></a></td>";
                                                                echo "<td><a class='btn btn-danger' href='oastatus_update.php?did=" . $row["oa_id"] . "'><i class='bi bi-x-circle'></i></a></td>";

                                                                echo "</tr>";
                                                                $tid++;
                                                            }
                                                        } else {
                                                            echo "0 results";
                                                        }

                                                        // Close the database connection
                                                        mysqli_close($conn);
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
                <!-- อนุมัติข้อมูลผู้หน่วยงานภายนอก -->
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>โรงพยาบาลตรัง</strong></a> &copy;
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>

    <script src="js/app.js"></script>


</body>

</html>