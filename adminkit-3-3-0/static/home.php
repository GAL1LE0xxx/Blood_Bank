<?php
include "connect.php";
session_start();
session_destroy();

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
    <link rel="shortcut icon" href="img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <title>หน้าหลัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

</head>

<body>

    <div class="wrapper">

        <div class="main">

            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="home.php">
                    <img width="60" height="60" src="img\photos\logo.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>

            </nav>

            <nav class="navbar justify-content-center navbar-bg bg-danger ">
                <ul class="nav justify-content-center gap-2 ">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="admin/pr.php">ข่าวสาร</a>
                    </li>
                    <li class="nav-item ">
                        <a class="btn btn-outline-light" href="outsideagency/oasign-in.php">หน่วยงานภายนอก</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="donor/donorsign-in.php">ผู้บริจาค</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="login.php">เจ้าหน้าที่</a>
                    </li>
                </ul>
            </nav>
            <!-- จบ nav บน -->

            <main class="content">
                <!-- slide รูป -->
                <div class="container">
                    <div id="carouselSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <div id="carouselSlider" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img\photos\banner1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img\photos\banner2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img\photos\banner3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlider" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselSlider" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- จบ slide รูป -->

                    <!-- pr-->
                    <div class="mt-4 d-flex justify-content-center align-items-center">
                        <div class="container">
                            <div class="d-inline-flex-center p-2 bg-danger text-white text-center" style="font-size: 20px; border-radius: 20px;">ข่าวการประชาสัมพันธ์</div>
                            <?php
                            include("connect.php");

                            // คำนวณหน้าที่กำลังแสดงอยู่
                            $limit = 3; // จำนวนรายการต่อหน้า
                            $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                            $start_from = ($current_page - 1) * $limit;

                            // ดึงข้อมูลจากฐานข้อมูลโดยใช้ LIMIT และ OFFSET
                            $sql = "SELECT * FROM publicrelations ORDER BY pr_id DESC LIMIT $start_from, $limit";
                            $result = mysqli_query($conn, $sql);

                            echo '<div class="container mt-5">';
                            echo '<div class="row">';

                            // ตรวจสอบว่ามีข้อมูลหรือไม่
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="col-md-4 col-sm-6 mb-4">';
                                    echo '<div class="card">';
                                    echo '<a href="admin/pr_topic.php?id=' . $row['pr_id'] . '">';
                                    echo '<div class="image-container">';
                                    echo '<img src="uploads/' . $row['pr_image'] . '" class="responsive-image" alt="Responsive Image" style="width: 100%; height: 360px; object-fit: cover;">';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="text-center">' . $row['pr_topic'] . '</h5>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a>';
                                }
                            }

                            echo '</div>';
                            echo '</div>';

                            ?>
                            <div class=" d-md-flex justify-content-md-center">
                                <a class="btn btn-outline-danger btn-lg" href="admin/pr.php" role="button">ดูทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    mysqli_close($conn);
                    ?>
                    <!-- pr-->

                    <!-- ปริมาณเลือด -->
                    <div class="mt-4 d-flex justify-content-center align-items-center">
                        <div class="container">
                            <div class="d-inline-flex-center p-2 bg-danger text-white text-center" style="font-size: 20px; border-radius: 20px;">ปริมาณโลหิต</div>
                            <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                            <div class="col">
                                    <div class="card h-100">
                                        <img src="img\blood\a.png" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">ปริมาณโลหิตหมู่ A</h5>

                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="img\blood\b.png" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">ปริมาณโลหิตหมู่ B</h5>

                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="img\blood\o.png" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">ปริมาณโลหิตหมู่ O</h5>

                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="img\blood\ab.png" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">ปริมาณโลหิตหมู่ AB</h5>

                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ปริมาณเลือด -->

                    <!-- ปุ่มกลับด้านบน -->
                    <button onclick="scrollToTop()" id="scrollToTopButton" class="btn btn-danger">
                        <i class="bi bi-arrow-up-circle"></i>
                    </button>
                    <!-- ปุ่มกลับด้านบน -->
                </div>

            </main>
        </div>

    </div>


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



    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js " integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            var scrollToTopButton = document.getElementById('scrollToTopButton');
            if (window.scrollY > (document.documentElement.scrollHeight - window.innerHeight) * 0.75) {
                scrollToTopButton.classList.add('show');
            } else {
                scrollToTopButton.classList.remove('show');
            }
        });

        function scrollToTop() {
            window.scrollTo({   
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    <!-- จบปุ่มกลับด้านบน -->
</body>

</html>