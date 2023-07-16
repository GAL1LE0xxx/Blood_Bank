<?php
include "connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM donor WHERE dn_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['dn_username'];
    $name = $row['dn_name'];
    $persernalid = $row['dn_persernalid'];
    $email = $row['dn_email'];
    $address = $row['dn_address'];
    $phonenumber = $row['dn_phonenumber'];
    $gender = $row['dn_gender'];
    $birthdate = $row['dn_birthdate'];
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
    <link rel="shortcut icon" href="/img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>จัดการข้อมูลการสมัครสมาชิก</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">ธนาคารเลือด<br>โรงพยาบาลตรัง</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="home.php">
                            <i class="align-middle" data-feather="home"></i> <span class="align-middle">หน้าหลัก</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        จัดการข้อมูล
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="member.php">
                            <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">จัดการข้อมูลสมาชิก</span>
                        </a>
                    </li>



                    <li class="sidebar-header">
                        รายงาน
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-buttons.html">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">ข้อมูลผู้บริจาคโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">การจองคิว</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">ข้อมูลปริมาณโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">ข้อมูลสถานะโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
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
                                <a class="dropdown-item" href="login.php">Log out</a>
                            </div>
                        </li>
            </nav>

            <main class="content">
                <!--เพิ่มข้อมูลผู้ใช้-->
                <div class="container-fluid p-0">

                    <div class="row justify-content-md-center">
                        <div class="col-12 col-lg-8 col-xxl- d-flex">

                            <div class="card flex-fill ">

                                <div class="table-responsive">
                                    <tbody>
                                        <div class="contentdata ">

                                            <div class="m-sm-4">
                                                <form action="member_edit_db.php" method="post">
                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ลำดับ</h5>
                                                        <input type="text" class="form-control " name="dn_id" value="<?php echo $id ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">ชื่อผู้ใช้</h5>
                                                        <input type="text" class="form-control " name="username" value="<?php echo $username ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">ชื่อ-สกุล</label>
                                                        <input type="text" class="form-control "  name="name" value="<?php echo $name ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">เลขประจำตัวประชาชน</label>
                                                        <input type="text" class="form-control "  name="persernalid" value="<?php echo $persernalid ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">อีเมล</label>
                                                        <input type="text" class="form-control "  name="email" value="<?php echo $email ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">ที่อยู่</label>
                                                        <input type="text" class="form-control "  name="address" value="<?php echo $address ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                                        <input type="text" class="form-control "  name="phonenumber" value="<?php echo $phonenumber ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <h5 class="card-title mb-3">เพศ</h5>
                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="mele" name="gender" value="0"
                                                            <?php if ($gender == "0") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>
                                                                required>
                                                            <span class="form-check-label">
                                                                ชาย
                                                            </span>
                                                        </label>

                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="femele" name="gender" value="1"> <span class="form-check-label"
                                                            <?php if ($gender == "1") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>
                                                                required>
                                                                <span class="form-check-label">
                                                                หญิง
                                                            </span>
                                                        </label>

                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">วัน/เดือน/ปี เกิด</label>
                                                        <input type="date" class="form-control "  name="birthdate" value="<?php echo $birthdate ?>" required>
                                                    </div>

                                                    <button type="submit" class='btn btn-success' name="edit_member">ยืนยัน</button>
                                                    <td><a class='btn btn-danger' href='member.php'>ย้อนกลับ</a></td>
                                                </form>
                                            </div>


                                        </div>
                                    </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--จบเพิ่มข้อมูลผู้ใช้-->
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