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
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    
    <title>จัดการข้อมูลโลหิต</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
                    </ul>
                </div>
            </nav>

            <main class="content">
                <!-- จัดการข้อมูลโลหิตรวม -->
                <div class="container-fluid p-0">   

                    <h1 class="h3 mb-3 "><strong>จัดการข้อมูลโลหิตรวม</strong> </h1>
                    <div class="container-fluid p-0">
                    <div class="row">

                        <div class="col-12 col-lg-100 col-xxl- d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <a href="wbblood_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover my-0 ">
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
        <!-- จบจัดการข้อมูลโลหิตรวม -->

        <!-- จัดการข้อมูลโลหิตเฉพาะส่วน -->
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3 mt-5"><strong>จัดการข้อมูลโลหิตประเภทเฉพาะส่วน</strong> </h1>
            <div class="container-fluid p-0">
                <div class="row">

                    <div class="col-12 col-lg-100 col-xxl- d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <a href="specificblood_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i> เพิ่มข้อมูล</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover my-0 ">
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
                            </div>
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

    <script src="js/app.js"></script>


</body>

</html>