<!--เรียกใช้ไฟล์ connect.php-->
<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>สมัครสมาชิก</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login-form-20/css/style.css">

</head>

<body class="img js-fullheight" style="background-image: url(login-form-20/images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">สมัครสมาชิก</h3>
                        <?php if (isset($_SESSION['success'])) : ?>
                            <div class="notification">
                                <h3>
                                    <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        <?php if (isset($_SESSION['errors'])) : ?>
                            <div class="notification">
                                <h3>
                                    <?php
                                    echo $_SESSION['errors'];
                                    unset($_SESSION['errors']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        <form action="register_db.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password2" placeholder="ยืนยันรหัสผ่าน" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="firstname" placeholder="ชื่อ" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastname" placeholder="นามสกุล" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="อีเมล" required>
                            </div>
                            <div class="form-group">
                                เพศ:<br>
                                <input type="radio" id="male" name="gender" value="0" required>
                                <label for="male">ชาย</label>
                                <input type="radio" id="female" name="gender" value="1">
                                <label for="female">หญิง</label><br>
                            </div>
                            <div class="form-group">
                                วัน/เดือน/ปี เกิด:
                                <input type="date" class="form-control" name="birthdate" required>
                            </div>
                            <p>ลงทะเบียนแล้ว?<a href="login.php"> เข้าสู่ระบบ</a></p>
                            <div class="form-group">
                                <button type="submit" name="reg_user" class="form-control btn btn-primary submit px-3">ลงทะเบียน</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="login-form-20/js/jquery.min.js"></script>
    <script src="login-form-20/js/popper.js"></script>
    <script src="login-form-20/js/bootstrap.min.js"></script>
    <script src="login-form-20/js/main.js"></script>

</body>

</html>