<?php
include('../connect.php');
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: donorsign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$id = $_SESSION['id'];
$username = $_SESSION['username'];

// แก้ไข SQL query ให้ถูกต้อง
$sql = "SELECT * FROM `donor` WHERE dn_id = '$id'";
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="home.php">
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
                            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <main class="content">
                <div class="container-xl mt-3 ">
                    <div class="col-xl-100">
                        <!-- Account details card-->
                        <div class="mt-3 card-hader ">
                            <h2>ตั้งค่าโปรไฟล์</h2>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="m-sm-4">
                                        <form action="donorprofile_db.php" method="post">
                                            <input class="form-control" name="id" type="hidden" value="<?php echo $row['dn_id'] ?>">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="text mb-1" for="username">ชื่อผู้ใช้</label>
                                                    <input class="form-control" name="username" type="text" value="<?php echo $row['dn_username'] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text mb-1" for="name">ชื่อ-สกุล</label>
                                                    <input class="form-control" name="name" type="text" value="<?php echo $row['dn_name'] ?>">
                                                </div>
                                            </div>

                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="text mb-1" for="persernalid">เลขประจำตัวประชาชน</label>
                                                    <input class="form-control" name="persernalid" type="text" value="<?php echo $row['dn_persernalid'] ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="text mb-1" for="phonenumber">เบอร์โทรศัพท์</label>
                                                    <input class="form-control" name="phonenumber" type="text" value="<?php echo $row['dn_phonenumber'] ?>">
                                                </div>
                                            </div>

                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="gender">เพศ</label>
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="gender">
                                                        <option selected>กรุณาเลือก</option>
                                                        <option value="0">ชาย</option>
                                                        <option value="1">หญิง</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">วัน/เดือน/ปี เกิด</label>
                                                    <input class="form-control" name="birthdate" type="date" value="<?php echo $row['dn_birthdate'] ?>">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">อีเมล</label>
                                                <input type="text" class="form-control " name="email" value="<?php echo $row['dn_email'] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">ที่อยู่</label>
                                                <input type="text" class="form-control " name="address" value="<?php echo $row['dn_address'] ?>">
                                            </div>

                                            <button type="submit" class='btn btn-success' name="edit_donor">ยืนยัน</button>
                                            <td><a class='btn btn-danger' href='donormenu.php'>ย้อนกลับ</a></td>
                                        </form>
                                    </div>
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
                            const redirectURL = 'donorprofile.php';
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
                            const redirectURL = 'donorprofile.php';
                            window.location.href = redirectURL;
                        }
                    });
                }
            </script>
</body>

</html>