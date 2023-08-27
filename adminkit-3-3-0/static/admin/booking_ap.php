<?php
include('../connect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
    exit;
}

$user = $_SESSION['username'];
$position = $_SESSION['position'];

$sql = "SELECT * FROM officer WHERE oc_username = '$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$oc_id = $row['oc_id'];
$user = $row['oc_username'];

if ($position !== '0') {
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
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../login.php">Log out</a>
                            </div>
                        </li>
            </nav>

            <main class="content">

                <!-- อนุมัติการจองคิวผู้หน่วยงานภายนอก -->
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>อนุมัติการจองคิวหน่วยงานภายนอก</strong> </h1>

                    <div class="row">
                        <div class="col-12 col-lg-15 col-xxl- d-flex">
                            <div class="card flex-fill">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover my-0 ">

                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>วันที่จอง</th>
                                                <th>เวลา</th>
                                                <th>สถานที่</th>
                                                <th>จำนวนผู้บริจาค</th>
                                                <th>ผู้จอง</th>
                                                <th>สถานะ</th>
                                                <th>อนุมัติโดย</th>
                                                <th>อนุมัติ</th>
                                                <th>ไม่อนุมัติ</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            // Include the database connection file
                                            include('../connect.php');

                                            // Initialize an empty array to store approved user IDs
                                            $approved_users = [];

                                            // Fetch data from the database using JOIN
                                            $sql = "SELECT o.*, a.*, oc.oc_username
        FROM outsiteservice o
        LEFT JOIN outsideagency a ON o.oa_id = a.oa_id
        LEFT JOIN officer oc ON o.oc_id = oc.oc_id";


                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                $tid = '1';

                                                // Output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $tid . "</td>";
                                                    echo "<td>" . $row["out_start"] . "</td>";
                                                    echo "<td>" . $row["out_time"] . "</td>";
                                                    echo "<td>" . $row["out_location"] . "</td>";
                                                    echo "<td>" . $row["out_amount"] . "</td>";
                                                    echo "<td>" . $row["oa_name"] . "</td>";

                                                    if ($row["out_approval"] == "0") {
                                                        echo "<td><span class=\"badge bg-warning\">รออนุมัติ</span></td>";
                                                    } elseif ($row["out_approval"] == "1") {
                                                        echo "<td><span class=\"badge bg-success\">อนุมัติ</span></td>";
                                                        // Store the approved user ID
                                                    } elseif ($row["out_approval"] == "2") {
                                                        echo "<td><span class=\"badge bg-danger\">ไม่อนุมัติ</span></td>";
                                                    }

                                                    echo "<td>" . $row["oc_username"] . "</td>";


                                                    echo "<td><a class='btn btn-success' href='bookingstatus.php?id=" . $row['out_id'] . "&oc_id=" . $oc_id . "'><i class='bi bi-check-circle'></i></a></td>";
                                                    echo "<td><a class='btn btn-danger' href='bookingstatus.php?did=" . $row['out_id'] . "&oc_id=" . $oc_id . "'><i class='bi bi-x-circle'></i></a></td>";


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
                                </div>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- อนุมัติการจองคิวผู้หน่วยงานภายนอก -->

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
    <script src="js/app.js"></script>


</body>

</html>