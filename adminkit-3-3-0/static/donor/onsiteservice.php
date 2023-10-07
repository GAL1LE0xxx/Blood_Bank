<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: donorsign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$user = $_SESSION['username'];
$logged_in_dn_id = $_SESSION['id'];


if (isset($_POST['on_date'])) {
    $searchKeyword = $_POST['on_date'];

    // สร้างคำสั่ง SQL สำหรับการค้นหาข้อมูลจากทั้ง 2 ตาราง
    $sql = "SELECT d.*, os.* FROM donor d
            INNER JOIN onsiteservice os ON d.dn_id = os.dn_id
            WHERE os.on_date LIKE '%$searchKeyword%' AND d.dn_id = '$logged_in_dn_id'";

    // ประมวลผลคำสั่ง SQL
    $result = mysqli_query($conn, $sql);
}

$searchKeyword = isset($_POST['on_date']) ? $_POST['on_date'] : '';
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
    <!-- <link href="style.css" rel="stylesheet"> -->
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
    <style>
        /* ใช้ CSS เพื่อเปลี่ยนสีปุ่มเป็นสีแดง */
        #back-button {
            background-color: #dc3545;
            color: white;
        }

        .nav-pills .nav-link.active {
            background-color: #dc3545;
            color: white;
        }
    </style>

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
                            <span class="text-dark"><?php echo $_SESSION['name']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="donorprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <main class="content">
                <div class="container overflow-hidden ">
                    <a class="btn btn-danger mt-3 mb-3" href="donormenu.php">ย้อนกลับ</a>

                    <!-- จองคิว -->
                    <div class="container-fluid p-0">
                        <div class="mt-4">
                            <div class="card mb-4 ">
                                <div class="card-body">
                                    <form class="form-control " action="onbooking_db.php" method="post">
                                        <div class="mt-2">
                                            <h3>กรอกข้อมูลการจองคิว</h3>
                                        </div>
                                        <input type="hidden" class="form-control form-control-lg" id="id" name="id" value="<?php echo $id ?>">
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">วันที่ต้องการจอง :</label>
                                                <input class="form-control form-control-lg" type="date" name="bookingdate" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="bookingtime">เวลา :</label>
                                                <input class="form-control form-control-lg" type="time" name="bookingtime" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="onbooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- จองคิว -->

                    <!-- ตรวจสอบคิว -->
                    <div class="container-fluid p-0">
                        <div class="mt-4">
                            <div class="card mb-4 ">
                                <div class="card-body">
                                    <div class="container mt-3">

                                        <form class="form-control" action="" method="POST"> <!-- แก้ไข action และ method -->
                                            <div class="mt-2">
                                                <h3>ตรวจสอบข้อมูลการจองคิว</h3>
                                            </div>
                                            <div class="mb-3">
                                                <label for="on_date" class="form-label">กรอกวันที่จองคิวของท่าน:</label>
                                                <input type="date" class="form-control" name="on_date" value="<?php echo $searchKeyword ?>">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                                <button type="submit" class="btn btn-danger" name="clear" value="true" id="clearBtn">เคลียร์</button>
                                            </div>
                                            <?php if (isset($_POST['clear'])) {
                                                $searchKeyword = '';
                                                unset($result);
                                            } ?>
                                        </form>

                                        <?php if (!empty($result)) : ?>
                                            <table class="table table-bordered mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>ชื่อผู้จอง</th>
                                                        <th>วันที่จอง</th>
                                                        <th>เวลา</th>
                                                        <th>ยกเลิก</th>
                                                        <!-- เพิ่มคอลัมน์ตามโครงสร้างของตาราง -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $tid = 1; ?>
                                                    <?php if ($result->num_rows > 0) : ?>
                                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?= $tid ?></td>
                                                                <td><?= $row["dn_name"] ?></td>
                                                                <td><?= date("d/m/Y", strtotime($row["on_date"])) ?></td>
                                                                <td><?= $row["on_time"] ?></td>
                                                                <td>
                                                                    <a class='btn btn-danger' href='onbooking_delete_db.php?did=<?php echo $row["on_id"]; ?>' onclick="return confirmDelete('<?php echo $row["on_id"]; ?>')">
                                                                        <i class='bi bi-trash'>ยกเลิก</i>
                                                                    </a>
                                                                </td>
                                                                <!-- เพิ่มเติมคอลัมน์ตามโครงสร้างของตาราง -->
                                                            </tr>
                                                            <?php $tid++; ?>

                                                        <?php endwhile; ?>
                                                    <?php elseif (!empty($searchKeyword)) : ?>
                                                        <tr>
                                                            <td colspan="7">ขออภัยไม่พบข้อมูล</td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- ตรวจสอบคิว -->

                </div>
        </div>
        </main>


    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

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
                    const redirectURL = 'onsiteservice.php';
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
                    const redirectURL = 'onsiteservice.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
    <script>
        document.getElementById("clearBtn").addEventListener("click", function() {
            document.getElementById("on_date").value = ""; // เคลียร์ค่าในช่องค้นหา
        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "ข้อมูลนี้ไม่สามารถกู้คืนได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ยืนยันการลบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'onbooking_delete_db.php?did=' + id;
                }
            });
            return false; // ไม่เปิดลิงก์อื่น
        }
    </script>

</body>


</html>