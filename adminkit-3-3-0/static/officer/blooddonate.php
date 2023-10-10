<?php
session_start();
if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: ../login.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$position = $_SESSION['position'];
if ($position !== '1') {
    $errorMessage = "สำหรับเจ้าหน้าที่เท่านั้น";
    header("Location: ../login.php?status=error&msg=" . urlencode($errorMessage));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>จัดการข้อมูลการบริจาคโลหิต</title>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>


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
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="tmedprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                </div>
            </nav>
            <main class="content">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-wholedonation-tab" data-bs-toggle="pill" data-bs-target="#pills-wholedonation" type="button" role="tab" aria-controls="pills-wholedonation" aria-selected="true">โลหิตรวม</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-specificdonation-tab" data-bs-toggle="pill" data-bs-target="#pills-specificdonation" type="button" role="tab" aria-controls="pills-specificdonation" aria-selected="false">โลหิตเฉพาะส่วน </button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-wholedonation" role="tabpanel" aria-labelledby="pills-wholedonation-tab">
                        <div class="container-fluid p-0">
                            <h1 class="h3 mb-3"><strong>จัดการข้อมูลการบริจาคโลหิตรวม</strong></h1>
                            <div class="row">
                                <div class="col-12 col-lg-15 col-xxl- d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-header">
                                            <a href="wdonate_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="myTable" class="table table-hover my-0">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับที่</th>
                                                        <th>วันที่บริจาค</th>
                                                        <th>ปริมาณโลหิตที่บริจาค (มิลลิลิตร)</th>
                                                        <th>ผู้บริจาค</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข</th>
                                                        <th>ลบ</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    // เชื่อมต่อ database
                                                    include('../connect.php');

                                                    // ดึงข้อมูลจาก database โดยใช้ JOIN และเรียงลำดับ
                                                    $sql = "SELECT wholedonation.*, donor.dn_name FROM wholedonation JOIN donor ON wholedonation.dn_id = donor.dn_id ORDER BY wholedonation.wd_date DESC";

                                                    $result = mysqli_query($conn, $sql);
                                                    $tid = 1;

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $tid . "</td>";
                                                            echo "<td>" . date("d/m/Y", strtotime($row["wd_date"])) . "</td>";
                                                            echo "<td>" . $row["wd_amount"] . "</td>";
                                                            echo "<td>" . $row["dn_name"] . "</td>";

                                                            if ($row["wd_status"] == "0") {
                                                                echo "<td><span class=\"badge bg-warning\">ยังไม่ถูกนำไปใช้</span></td>";
                                                            } elseif ($row["wd_status"] == "1") {
                                                                echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                            } elseif ($row["wd_status"] == "2") {
                                                                echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                            }
                                                            echo "<td><a class='btn btn-primary' href='wdonate_edit.php?id=" . $row["wd_id"] . "'><i class='bi bi-pencil-square'></i></a></td>";
                                                    ?>
                                                            <td>
                                                                <a class="btn btn-danger" onclick="confirmDelete('<?php echo $row["dn_name"]; ?>', '<?php echo $row["wd_id"]; ?>');">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                            </td>
                                                    <?php

                                                            $tid++;
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }

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
                    <div class="tab-pane fade" id="pills-specificdonation" role="tabpanel" aria-labelledby="pills-specificdonation-tab">
                        <div class="container-fluid p-0">
                            <h1 class="h3 mb-3"><strong>จัดการข้อมูลการบริจาคโลหิตเฉพาะส่วน</strong></h1>
                            <div class="row">
                                <div class="col-12 col-lg-15 col-xxl- d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-header">
                                            <a href="sdonate_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="myTable2" class="table table-hover my-0">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับที่</th>
                                                        <th>วันที่บริจาค</th>
                                                        <th>โลหิตเฉพาะส่วน</th>
                                                        <th>ปริมาณโลหิตที่บริจาค (มิลลิลิตร)</th>
                                                        <th>ผู้บริจาค</th>
                                                        <th>สถานะ</th>
                                                        <th>แก้ไข</th>
                                                        <th>ลบ</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    // เชื่อมต่อ database
                                                    include('../connect.php');

                                                    // ดึงข้อมูลจาก database โดยใช้ JOIN และเรียงลำดับ
                                                    $sql = "SELECT specificdonation.*, donor.dn_name FROM specificdonation JOIN donor ON specificdonation.dn_id = donor.dn_id ORDER BY specificdonation.sd_date DESC";

                                                    $result = mysqli_query($conn, $sql);
                                                    $tid = 1;

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $tid . "</td>";
                                                            echo "<td>" . date("d/m/Y", strtotime($row["sd_date"])) . "</td>";

                                                            if ($row["sb_id"] === "1") {
                                                                echo "<td>พลาสม่า</td>";
                                                            } elseif ($row["sb_id"] === "2") {
                                                                echo "<td>เม็ดเลือดแดง</td>";
                                                            } elseif ($row["sb_id"] === "3") {
                                                                echo "<td>เกล็ดเลือด</td>";
                                                            } else {
                                                                echo "<td>Unknown</td>";
                                                            }
                                                            echo "<td>" . $row["sd_amount"] . "</td>";
                                                            echo "<td>" . $row["dn_name"] . "</td>";

                                                            if ($row["sd_status"] == "0") {
                                                                echo "<td><span class=\"badge bg-warning\">ยังไม่ถูกนำไปใช้</span></td>";
                                                            } elseif ($row["sd_status"] == "1") {
                                                                echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                            } elseif ($row["sd_status"] == "2") {
                                                                echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                            }
                                                            echo "<td><a class='btn btn-primary' href='sdonate_edit.php?id=" . $row["sd_id"] . "'><i class='bi bi-pencil-square'></i></a></td>";
                                                    ?>
                                                            <td>
                                                                <a class="btn btn-danger" onclick="confirmDelete2('<?php echo $row["dn_name"]; ?>', '<?php echo $row["sd_id"]; ?>');">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                            </td>
                                                    <?php

                                                            $tid++;
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }

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
            </main>
        </div>
    </div>
    <script>
        // Get the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msg = urlParams.get('msg');

        // Check the status and display the SweetAlert message
        if (status === 'success') {
            Swal.fire({
                title: 'Success',
                text: msg,
                icon: 'success',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'blooddonate.php';
                    window.location.href = redirectURL;
                }
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error',
                text: msg,
                icon: 'error',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'blooddonate.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
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
    <script>
        function confirmDelete(name, id) {
            Swal.fire({
                title: "คุณแน่ใจหรือไม่?",
                text: "คุณต้องการลบข้อมูลของ " + name + " ข้อมูลนี้ไม่สามารถกู้คืนได้",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่, ลบเลย",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าคลิก "ใช่, ลบเลย" ให้เปลี่ยนเป็นลิงก์ลบจริงๆ
                    window.location.href = "wdonate_delete_db.php?did=" + id;
                }
            });
        }
    </script>
    <script>
        function confirmDelete2(name, id) {
            Swal.fire({
                title: "คุณแน่ใจหรือไม่?",
                text: "คุณต้องการลบข้อมูลของ " + name + " ข้อมูลนี้ไม่สามารถกู้คืนได้",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่, ลบเลย",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าคลิก "ใช่, ลบเลย" ให้เปลี่ยนเป็นลิงก์ลบจริงๆ
                    window.location.href = "sdonate_delete_db.php?did=" + id;
                }
            });
        }
    </script>



</body>

</html>