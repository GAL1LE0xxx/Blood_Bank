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
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>ข่าวสาร</title>

    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg ">
            <a href="home.php">
                <img width="60" height="60" src="..\img\photos\logo.png" alt="logo">
            </a>
            <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>

        </nav>

        <main class="content">
            <?php
            include "../connect.php";

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM publicrelations WHERE pr_id = '$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $topic = $row['pr_topic'];
                $details = $row['pr_details'];
                $image = $row['pr_image'];
                $date = $row['pr_date'];
            }

            // Function to translate English month names to Thai
            function translateMonthToThai($date)
            {
                $englishMonths = array(
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                );

                $thaiMonths = array(
                    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                    'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                );

                $date = str_replace($englishMonths, $thaiMonths, $date);
                return $date;
            }

            ?>

            <div class="container">
                <?php
                echo '<p class="fs-1">' . $row['pr_topic'] . '</p>';
                // Convert date to Thai format
                $thaiYear = intval(date("Y", strtotime($row['pr_date']))) + 543;
                $thaiMonth = translateMonthToThai(date("F", strtotime($row['pr_date'])));
                $thaiDate = date("d", strtotime($row['pr_date'])) . ' ' . $thaiMonth . ' ' . $thaiYear;
                echo '<h5>อัพโหลดเมื่อ: ' . $thaiDate . '</h5>';
                echo '<img src="' . $row['pr_image'] . '" class="img-fluid mt-4" alt="..." style="width: 100%; height: 550px; object-fit: cover;">';
                echo '<h3 class=" text-center mt-4">' . $row['pr_details'] . '</h3>';
                ?>
            </div>
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
</body>

</html>