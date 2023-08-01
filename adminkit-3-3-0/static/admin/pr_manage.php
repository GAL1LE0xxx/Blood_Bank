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
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>จัดการข้อมูลประชาสัมพันธ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>จัดการข้อมูลประชาสัมพันธ์</strong></h1>
                    <div class="row">
                        <div class="col-12 col-lg-15 col-xxl- d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <a href="pr_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข่าว</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover my-0">
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

                                            // Pagination settings
                                            $records_per_page = 10; // Number of records to display per page
                                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start_from = ($current_page - 1) * $records_per_page;

                                            // ดึงข้อมูลจาก database โดยใช้ LIMIT เพื่อแบ่งหน้า
                                            $sql = "SELECT * FROM publicrelations ORDER BY pr_date DESC LIMIT $start_from, $records_per_page";
                                            $result = mysqli_query($conn, $sql);


                                            if (mysqli_num_rows($result) > 0) {
                                                $tid = ($current_page - 1) * $records_per_page + 1;
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

                                            // หาจำนวนหน้าทั้งหมดเพื่อสร้าง navigation links
                                            $sql_total = "SELECT COUNT(*) AS total_records FROM publicrelations";
                                            $result_total = mysqli_query($conn, $sql_total);
                                            $row_total = mysqli_fetch_assoc($result_total);
                                            $total_records = $row_total['total_records'];
                                            $total_pages = ceil($total_records / $records_per_page);

                                            // ปิด database
                                            mysqli_close($conn);
                                            ?>

                                        </tbody>
                                    </table>

                                    <!-- Add the pagination links below the table using Bootstrap -->
                                    <div class="mt-3">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center">
                                                <?php if ($current_page > 1) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="ก่อนหน้า">
                                                            <span aria-hidden="true">ก่อนหน้า</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                    <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($current_page < $total_pages) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="ต่อไป">
                                                            <span aria-hidden="true">ต่อไป</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
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


</body>

</html>