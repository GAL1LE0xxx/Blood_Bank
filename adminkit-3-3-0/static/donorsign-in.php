<?php
include("connect.php");
session_start();
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
    <link rel="shortcut icon" href="uploads/logo1.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>ผู้บริจาค</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <section class="ftco-section d-flex align-items-center mt-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mt-5">
                    <h2 class="heading-section"></h2>
                    <div class="login-wrap p-0">
                        <img src="uploads/logo1.png" alt="" width="200" height="200">

                        <h2 class="mb-4 text-center mt-5">ระบบจัดการธนาคารเลือด โรงพยาบาลตรัง</h2>
                        <h2 class="mb-4 text-center">สำหรับผู้บริจาค</h2>

                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <form class="form-floating" action="donorsign-indb.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้">
                                <label for="floatingInput">ชื่อผู้ใช้</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
                                <label for="floatingPassword">รหัสผ่าน</label>
                            </div>

                            <div class="mb-4 text-center mt-3">
                                <p>ยังไม่ได้ลงทะเบียน ? <a href="outside_sign-up.php">สมัครสมาชิก</a></p>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="donorsignin" class="form-control btn btn-danger btn-lg submit px-3">เข้าสู่ระบบ</button>
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
                    const redirectURL = 'donorsign-in.php';
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
                    const redirectURL = 'donorsign-in.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
</body>

</html>