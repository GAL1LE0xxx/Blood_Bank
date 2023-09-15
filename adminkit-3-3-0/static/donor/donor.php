<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้บริจาค</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
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
                            <a class="dropdown-item" href="donorprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <div class="container">
                <a class="btn btn-danger mt-5 " href="donormenu.php">ย้อนกลับ</a>
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="text-center mb-3">ข้อแนะนำเตรียมตัวก่อนบริจาคโลหิต</h2>
                        <p > 1. พักผ่อนให้เพียงพอไม่น้อยกว่า 5 ชั่วโมง หากอยู่ระหว่างรับประทานยรักษาโรค ให้แจ้งแพทย์/พยาบาล</p>
                        <p > 2. หลักเลี่ยงการรับประทานอาหารที่มีไขมันสูง เช่น ข้าวขาหมู ข้าวมันไก่ ขนมหวาน ก่อนมาบริจาคโลหิต 6 ชั่วโมง</p>
                        <p > 3. ก่อนบริจาคเลือด และก่อนเจาะเลือดบริจาคให้ดื่มน้ำ 3-4 แก้ว จะช่วยทำให้โลหิตไหลเวียนดีขึ้น</p>
                        <p > 4. งดเครื่องดื่มแอลกอฮอล์ งดสูบบุหรี่ทั้งก่อนและหละว บริจาคโลหิต 1 ชั่วโมง</p>
                        <p > 5. หลังบริจาคเลือด ควรดื่มน้ำให้มากกว่าปกติและรับประทานยาเสริมธาตุเหล็ก วันละ 1 เม็ด หลังอาหารจนหมด เพื่อชดเชยธาตุเหล็กที่สูญเสียไป</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>