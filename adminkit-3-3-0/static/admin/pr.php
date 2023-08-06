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
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>ข่าวสาร</title>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a href="../home.php">
                <img width="60" height="60" src="..\img\photos\logo.png" alt="logo">
            </a>
            <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital</span>
        </nav>

        <main class="content">

            <div class="mt-3 text-center">
                <h1>ข่าวสารประชาสัมพันธ์</h1>
            </div>

            <?php
            include("../connect.php");

            // คำนวณหน้าที่กำลังแสดงอยู่
            $limit = 6; // จำนวนรายการต่อหน้า
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
                    echo '<a href="pr_topic.php?id=' . $row['pr_id'] . '">';
                    echo '<div class="image-container">';
                    echo '<img src="' . $row['pr_image'] . '" class="responsive-image" alt="Responsive Image" style="width: 100%; height: 360px; object-fit: cover;">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="text-center">' . $row['pr_topic'] . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';

                // สร้างลิงก์ Pagination
                $pagination_sql = "SELECT COUNT(*) AS total FROM publicrelations";
                $pagination_result = mysqli_query($conn, $pagination_sql);
                $pagination_row = mysqli_fetch_assoc($pagination_result);
                $total_records = $pagination_row['total'];
                $total_pages = ceil($total_records / $limit);


                echo '<ul class="pagination justify-content-center">';
                if ($current_page > 1) {
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="?page=' . ($current_page - 1) . '" aria-label="Previous">';
                    echo '<span aria-hidden="true">ก่อนหน้า</span>';
                    echo '</a>';
                    echo '</li>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i === $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($current_page < $total_pages) {
                    echo '<li class="page-item">';
                    echo '<a class="page-link" href="?page=' . ($current_page + 1) . '" aria-label="Next">';
                    echo '<span aria-hidden="true">ต่อไป</span>';
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                // ไม่พบข้อมูล
                echo '<div class="col-12 text-center">ไม่มีข้อมูล</div>';
            }

            echo '</div>';
            echo '</div>';

            mysqli_close($conn);
            ?>



        </main>

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