<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>เข้าสู่ระบบ</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login-form-20/css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(login-form-20/images/bg.jpg);">
<section class="ftco-section mt-5">
    <div class="container ">
        <div class="row justify-content-end">
            <div class="col-md-6 col-lg-4 mt-5">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">ระบบจัดการธนาคารเลือด</h3>
                    <h3 class="mb-4 text-center">โรงพยาบาลตรัง</h3>
                    <h3 class="mb-4 text-center">สำหรับหน่วยงานภายนอก</h3>

                    <form action="oalogin_db.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="mb-4 text-center">
                            <p>ยังไม่ได้ลงทะเบียน ? <a href="outside_sign-up.php"> สมัครสมาชิก</a></p>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="login_user" class="form-control btn btn-primary submit px-3">เข้าสู่ระบบ</button>
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