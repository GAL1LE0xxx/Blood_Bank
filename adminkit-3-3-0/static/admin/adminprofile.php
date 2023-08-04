<?php
include('../connect.php');

session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];
$position = $_SESSION['position'];

$sql = "SELECT * FROM `officer` WHERE oc_id = '$id'";
$result = mysqli_query($conn, $sql);

// ตรวจสอบตำแหน่งของผู้ใช้ ถ้าไม่ใช่แอดมินให้ redirect ไปที่หน้า logout.php
if ($position != '0') {
    header("Location: ../logout.php");
    exit; // จบการทำงานของสคริปต์ทันทีหลังจาก redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
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
                <div class="container-xl mt-3 ">
                    <div class="col-xl-100">
                        <!-- Account details card-->
                        <div class="mt-3 card-hader">
                            <h2>ตั้งค่าโปรไฟล์</h2>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <form action = "adminprofile_db.php" method ="post">
                                        <input class="form-control" name ="id" type="hidden" value="<?php echo $row['oc_id'] ?>">
                                        <div class="mb-3">
                                            <label class="text mb-1" for="username">ชื่อผู้ใช้</label>
                                            <input class="form-control" name ="username" type="text" value="<?php echo $row['oc_username'] ?>">
                                        </div>
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="firstname">ชื่อ</label>
                                                <input class="form-control" name ="firstname" type="text" value="<?php echo $row['oc_firstname'] ?>">
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="lastname">สกุล</label>
                                                <input class="form-control" name ="lastname" type="text" value="<?php echo $row['oc_lastname'] ?>">
                                            </div>
                                        </div>
                                        <!-- Form Row        -->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (organization name)-->
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="phonenumber">เบอร์โทรศัพท์</label>
                                                <input class="form-control" name ="phonenumber" type="text" value="<?php echo $row['oc_phonenumber'] ?>">
                                            </div>
                                            <!-- Form Group (location)-->
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="position">ตำแหน่ง</label>
                                                <input class="form-control" name ="position" type="text" value="<?php if ($row['oc_position'] == "0") {
                                                                                                                        echo "แอดมิน";
                                                                                                                    } elseif ($row['oc_position']== "1") {
                                                                                                                        echo "นักเทคนิคการแพทย์";
                                                                                                                    } else {
                                                                                                                        echo "Unknown";
                                                                                                                    } ?> " readonly>
                                            </div>
                                        </div>

                                        <!-- Save changes button-->
                                        <button type = "submit" name="edit_adminprofile" class="mt-3 btn btn-primary" >บันทึก</button>
                                    </form>
                                <?php } ?>
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
</body>

</html>