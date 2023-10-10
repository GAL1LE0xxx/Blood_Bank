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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <title>จัดการข้อมูลโลหิต</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

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
                                <a class="dropdown-item" href="adminprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="mb-3">
                    <ul class="nav nav-pills " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="wbblood-tab" data-bs-toggle="tab" data-bs-target="#wbblood" type="button" role="tab" aria-controls="wbblood" aria-selected="true">จัดการข้อมูลโลหิตรวม</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specificblood-tab" data-bs-toggle="tab" data-bs-target="#specificblood" type="button" role="tab" aria-controls="specificblood" aria-selected="false">จัดการข้อมูลโลหิตเฉพาะส่วน</button>
                        </li>

                    </ul>
                </div>
                <!-- จัดการข้อมูลโลหิตรวม -->
                <div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="wbblood" role="tabpanel" aria-labelledby="wbblood-tab">
                            <div class="container-fluid p-0 mt-3">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-100 col-xxl- d-flex">
                                            <div class="card flex-fill">
                                                <div class="card-header">
                                                    <a href="wbblood_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                                                </div>
                                                <div class="table-responsive table-striped">
                                                    <table id="myTable" class="table table-hover my-0 ">

                                                        <thead>
                                                            <tr>
                                                                <th>ลำดับ</th>
                                                                <th>หมู่เลือด</th>
                                                                <th>แก้ไข </th>
                                                                <th>ลบ</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            // Include the database connection file
                                                            include('../connect.php');

                                                            // Fetch data from the database
                                                            $sql = "SELECT * FROM wholeblood";
                                                            $result = mysqli_query($conn, $sql);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Output data of each row
                                                                $tid = '1';
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo "<tr>";
                                                                    echo "<td>" . $tid . "</td>";
                                                                    echo "<td>" . $row["wb_bloodtype"] . "</td>";

                                                                    echo "<td><a class='btn btn-primary' href='wbblood_edit.php?id=" . $row["wb_id"] . "'><i class='bi bi-pencil-square'></i></a></td>";

                                                                    echo "<td><a class='btn btn-danger' href='wbblood_delete_db.php?did=" . $row["wb_id"] . "' onclick=\"return confirm('ต้องการลบผู้ใช้แน่หรือไม่? ข้อมูลนี้ไม่สามารถกู้คืนได้.');\"><i class='bi bi-trash'></i></a></td>";
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- จบจัดการข้อมูลโลหิตรวม -->

                <!-- จัดการข้อมูลโลหิตเฉพาะส่วน -->
                <div>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade" id="specificblood" role="tabpanel" aria-labelledby="specificblood-tab">
                            <div class="container-fluid p-0">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-100 col-xxl- d-flex">
                                            <div class="card flex-fill">
                                                <div class="card-header">
                                                    <a href="specificblood_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="myTable2" class="table table-hover my-0 ">
                                                        <thead>
                                                            <tr>
                                                                <th>ลำดับ</th>
                                                                <th>หมู่เลือด</th>
                                                                <th>แก้ไข </th>
                                                                <th>ลบ</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            // Include the database connection file
                                                            include('../connect.php');

                                                            // Fetch data from the database
                                                            $sql = "SELECT * FROM specificblood";
                                                            $result = mysqli_query($conn, $sql);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Output data of each row
                                                                $tid = '1';
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo "<tr>";
                                                                    echo "<td>" . $tid . "</td>";
                                                                    echo "<td>" . $row["sb_information"] . "</td>";

                                                                    echo "<td><a class='btn btn-primary' href='specificblood_edit.php?id=" . $row["sb_id"] . "'><i class='bi bi-pencil-square'></i></a></td>";

                                                                    echo "<td><a class='btn btn-danger' href='specificblood_delete_db.php?did=" . $row["sb_id"] . "' onclick=\"return confirm('ต้องการลบผู้ใช้แน่หรือไม่? ข้อมูลนี้ไม่สามารถกู้คืนได้.');\"><i class='bi bi-trash'></i></a></td>";
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
                </div>
                <!-- จัดการข้อมูลโลหิตเฉพาะส่วน -->
        </div>

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
    <script src="../js/app.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myTable2").DataTable();
        });
    </script>
    <script src="js/app.js"></script>

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
                    const redirectURL = 'blood.php';
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
                    const redirectURL = 'blood.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>

</html>