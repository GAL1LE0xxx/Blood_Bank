<?php
session_start();
if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: ../login.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$position = $_SESSION['position'];
if ($position != '0') {
    echo '<script>alert("สำหรับผู้ดูแลระบบเท่านั้น");window.location="../home.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

</html>

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

    <title>จัดการข้อมูลผู้ใช้</title>

    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="wrapper">
        <main class="content">
            <!-- จัดการข้อมูลเจ้าหน้าที่ -->
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3"><strong>จัดการข้อมูลผู้ใช้</strong> </h1>

                <div class="row">
                    <div class="col-12 col-lg-15 col-xxl- d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <a href="officer_add.php" class='btn btn-primary'><i class="bi bi-person-plus"></i>
                                    เพิ่มผู้ใช้</a>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover my-0 ">
                                    <thead>
                                        <tr>
                                            <th>ลำดับที่</th>
                                            <th>ชื่อผู้บริจาค</th>
                                            <th>หมู่โลหิต</th>
                                            <th>วันที่บริจาค</th>
                                            <th>สถานะโลหิต</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // เชื่อมต่อ database
                                        include('../connect.php');

                                        // ดึงข้อมูลจาก database
                                        $sql = "SELECT wd.*, d.dn_name, d.wb_id, wb.wb_bloodtype
                                        FROM wholedonation AS wd
                                        JOIN donor AS d ON wd.dn_id = d.dn_id
                                        JOIN wholeblood AS wb ON d.wb_id = wb.wb_id
                                        ";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $tid = 1; // ตัวแปรนับลำดับที่

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $tid . "</td>";
                                                echo "<td>" . $row["dn_name"] . "</td>"; // เปลี่ยน "ชื่อผู้บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                echo "<td>" . $row["wb_bloodtype"] . "</td>"; // เปลี่ยน "หมู่โลหิต" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                echo "<td>" . date("d/m/Y", strtotime($row['wd_date'])) . "</td>"; // เปลี่ยน "วันที่บริจาค" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                if ($row["wd_status"] == "0") {
                                                    echo "<td><span class=\"badge bg-warning\">สามารถนำไปใช้ได้</span></td>";
                                                } elseif ($row["wd_status"] == "1") {
                                                    echo "<td><span class=\"badge bg-success\">ถูกนำไปใช้แล้ว</span></td>";
                                                } elseif ($row["wd_status"] == "2") {
                                                    echo "<td><span class=\"badge bg-danger\">ไม่สามารถนำไปใช้ได้</span></td>";
                                                } // เปลี่ยน "สถานะโลหิต" เป็นชื่อคอลัมน์ที่คุณต้องการแสดง
                                                echo "</tr>";
                                                $tid++;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // ปิดการเชื่อมต่อ database
                                        mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- จบจัดการข้อมูลเจ้าหน้าที่ -->
        </main>

        <script src="../js/app.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
</body>

</html>