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
    <title>จัดการข้อมูลประชาสัมพันธ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/app.css" rel="stylesheet">
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
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="adminprofile.html"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>จัดการข้อมูลประชาสัมพันธ์</strong></h1>
                    <div class="row">
                        <div class="col-12 col-lg-15 col-xxl- d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <a href="pr_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข่าว</a>
                                </div>

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>หัวข้อ</th>
                                                <th>รายละเอียด</th>
                                                <th>วันที่เพิ่ม</th>
                                                <th>ผู้เพิ่ม</th>
                                                <th>รายละเอียด</th>
                                                <th>ลบ</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            // เชื่อมต่อ database
                                            include('../connect.php');

                                            // ดึงข้อมูลจาก database โดยใช้ LIMIT เพื่อแบ่งหน้าและเรียงลำดับ
                                            $sql = "SELECT * FROM publicrelations ORDER BY pr_date DESC";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                $tid = '1';

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $tid . "</td>";
                                                    echo '<td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $row["pr_topic"] . "</td>";
                                                    echo '<td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $row["pr_details"] . '</td>';
                                                    echo "<td>" . $row["pr_date"] . "</td>";
                                                    echo "<td></td>";
                                                    echo "<td><a class='btn btn-primary' href='pr_edit.php?id=" . $row["pr_id"] . "'><i class='bi bi-pencil-square'></i></a></td>";
                                                    echo "<td><a class='btn btn-danger' href='pr_delete_db.php?did=" . $row["pr_id"] . "' onclick=\"return confirm('ต้องการลบผู้ใช้แน่หรือไม่? ข้อมูลนี้ไม่สามารถกู้คืนได้.');\"><i class='bi bi-trash'></i></a></td>";
                                                    echo "</tr>";
                                                    $tid++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>0 results</td></tr>";
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="../js/app.js"></script>
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
                    const redirectURL = 'officer.php';
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
                    const redirectURL = 'officer.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>

</html>