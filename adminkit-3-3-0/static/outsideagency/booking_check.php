<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['out_location'])) {
    $searchKeyword = $_POST['out_location'];

    // สร้างคำสั่ง SQL สำหรับการค้นหา
    $sql = "SELECT * FROM outsiteservice WHERE out_location LIKE '%$searchKeyword%'";

    // ประมวลผลคำสั่ง SQL
    $result = $conn->query($sql);
}

$searchKeyword = isset($_POST['out_location']) ? $_POST['out_location'] : '';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบการจองคิว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                            <a class="dropdown-item" href="outsideprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <main class="content">

                <div class="container">
                    <h1 class="text-center text-light bg-danger rounded-3 mb-4">ตรวจสอบการจองคิว</h1>
                    <a class="btn btn-danger mt-3 mb-3" href="oamenu.php">ย้อนกลับ</a>
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <div class="container mt-3">
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label for="out_location" class="form-label">กรอกสถานที่บริจาคของท่าน:</label>
                                        <input type="text" class="form-control" name="out_location" value="<?php echo $searchKeyword ?>">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">ค้นหา</button>
                                        <button type="submit" class="btn btn-danger" name="clear" value="true" id="clearBtn">เคลียร์</button>
                                    </div>
                                    <?php if (isset($_POST['clear'])) {
                                        $searchKeyword = '';
                                        unset($result);
                                    } ?>
                                </form>

                                <?php if (!empty($result)) : ?>
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>วันที่เริ่ม</th>
                                                <th>วันที่เสร็จสิ้น</th>
                                                <th>เวลา</th>
                                                <th>สถานที่</th>
                                                <th>จำนวนผู้บริจาค</th>
                                                <th>ผลการอนุมัติ</th>
                                                <!-- เพิ่มคอลัมน์ตามโครงสร้างของตาราง -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result->num_rows > 0) : ?>
                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                    <tr>
                                                        <td><?= $row["out_id"] ?></td>
                                                        <td><?= $row["out_start"] ?></td>
                                                        <td><?= $row["out_end"] ?></td>
                                                        <td><?= $row["out_time"] ?></td>
                                                        <td><?= $row["out_location"] ?></td>
                                                        <td><?= $row["out_amount"] ?></td>
                                                        <?php if ($row["out_approval"] == "0") {
                                                            echo "<td><span class=\"badge bg-warning\">รออนุมัติ</span></td>";
                                                        } elseif ($row["out_approval"] == "1") {
                                                            echo "<td><span class=\"badge bg-success\">อนุมัติ</span></td>";
                                                            // Store the approved user ID
                                                        } elseif ($row["out_approval"] == "2") {
                                                            echo "<td><span class=\"badge bg-danger\">ไม่อนุมัติ</span></td>";
                                                        }
                                                        ?>
                                                        <!-- เพิ่มเติมคอลัมน์ตามโครงสร้างของตาราง -->
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php elseif (!empty($searchKeyword)) : ?>
                                                <tr>
                                                    <td colspan="7">ขออภัยไม่พบข้อมูล</td>
                                                </tr>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>

                            <?php $conn->close(); ?>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="footer bg-danger text-white">
                <div class="container-fluid">
                    <div class="row text-white">
                        <div class="col-sm-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                            <p class="mb-0">
                                <a class="text-white" href="home.php" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-white" href="home.php" target="_blank"><strong>โรงพยาบาลตรัง</strong></a>
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
        </div>
    </div>
    <script src="bootstrap.min.js"></script>
    <script>
        document.getElementById("clearBtn").addEventListener("click", function() {
            document.getElementById("out_location").value = ""; // เคลียร์ค่าในช่องค้นหา
        });
    </script>

</body>

</html>