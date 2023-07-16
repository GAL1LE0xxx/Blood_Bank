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
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>หน้าหลัก</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <div class="wrapper">

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="home.php">
                    <img width="60" height="60" src="img\photos\logo1.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <div class="login-container">
                            
                        </div>
                    </ul>
                </div>



            </nav>
            <nav class="navbar justify-content-center navbar-bg bg-danger ">
                <ul class="nav justify-content-center gap-2 ">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="pr.php">ข่าวสาร</a>
                    </li>
                    <li class="nav-item ">
                        <a class="btn btn-outline-light" href="oalogin.php">หน่วยงานภายนอก</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">สำหรับผู้บริจาค</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="login.php">สำหรับเจ้าหน้าที่</a>
                    </li>
                </ul>
            </nav>
            <!-- จบ nav บน -->

            <main class="content">
                <!-- slide รูป -->
                <div class="container">
                    <div id="carouselSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselSlider" data-bs-slide-to="0" class="active"></li>
                            <li data-target="#carouselSlider" data-bs-slide-to="1"></li>
                            <li data-target="#carouselSlider" data-bs-slide-to="2"></li>
                            <!-- <li data-target="#carouselSlider" data-bs-slide-to="3"></li> -->

                        </ol>
                        <div class="carousel-inner ">
                            <div class="carousel-item active ">
                                <img src="img\photos\banner1.jpg" class="d-block w-100" style="max-width: auto; height: auto;" alt="Slide 1">
                            </div>
                            <div class="carousel-item">
                                <img src="img\photos\banner2.jpg" class="d-block w-100" style="max-width: auto; height: auto;" alt="Slide 2">
                            </div>
                            <div class="carousel-item">
                                <img src="img\photos\banner3.jpg" class="d-block w-100" style="max-width: auto; height: auto;" alt="Slide 3">
                            </div>
                            <!-- <div class="carousel-item">
                                <img src="img\photos\banner1.jpg" class="d-block w-100" style="max-width: auto; height: auto;" alt="Slide 4">
                            </div> -->

                        </div>
                        <a class="carousel-control-prev" href="#carouselSlider" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselSlider" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- จบ slide รูป -->

                <!-- ปริมาณเลือด -->
                <div class="mt-4 d-flex justify-content-center align-items-center">
                    <div class="container-sm">
                        <div class="mt-2" style="text-align: center;">
                            <h1>ปริมาณเลือดในคลัง</h1>
                        </div>

                        <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img\blood\a.png" class="card-img-top" alt="news2">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img\blood\b.png" class="card-img-top" alt="news3">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img\blood\o.png" class="card-img-top" alt="news4">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img\blood\ab.png" class="card-img-top" alt="news1">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ปุ่มกลับด้านบน -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
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