<?php
session_start();
include "../connect.php";
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

</head>

<body>
    <div class="wrapper">
        <?php include "tmednav.php"; ?>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="tmedprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                            </div>
                        </li>
                </div>
            </nav>

            <main class="content">
                <div class="container">
                    <div class="container ">
                        <div class="card mb-4 ">
                            <div class="card-body">
                                <form id="multi-step-form" action="oc_process.php" method="POST">
                                    <input type="hidden" name="oc_id" value="<?php echo $_SESSION['id']; ?>">
                                    <div id="step0">
                                        <h2>แบบคัดกรองสุขภาพ</h2>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="donorid">รหัสผู้บริจาค :</label>
                                                <input class="form-control" name="donorid" type="text" placeholder="กรุณากรอกรหัสผู้บริจาค" onblur="fetchUserInfo()" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="user-info">ชื่อผู้บริจาค :</label>
                                                <input class="form-control" name="user-info" id="user-info" readonly>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="pressure">ความดันโลหิต (มิลลิเมตรปรอท) :</label>
                                                <input class="form-control" name="pressure" type="text" placeholder="ระบุความดันโลหิต (เช่น 120/80)" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="text mb-1" for="pulse">ชีพจร (ครั้งต่อนาที) :</label>
                                                <input class="form-control" name="pulse" type="text" placeholder="ระบุชีพจรครั้งต่อนาที" required>
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="hb">ระดับฮีโมโกลบิน (กรัมต่อเดซิลิตร) : </label>
                                                <input class="form-control" name="hb" type="text" placeholder="ระบุระดับฮีโมโกลบิน" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="text mb-1" for="temperature">อุณหภูมิร่างกาย (องศาเซลเซียส) :</label>
                                                <input class="form-control" name="temperature" type="text" placeholder="ระบุอุณหภูมิร่างกาย" required>
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="weight">น้ำหนัก (กิโลกรัม) :</label>
                                                <input class="form-control" name="weight" type="text" placeholder="ระบุน้ำหนัก" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="text mb-1" for="height">ส่วนสูง (เซนติเมตร) :</label>
                                                <input class="form-control" name="height" type="text" placeholder="ระบุส่วนสูง" required>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" type="button" id="next0">ถัดไป</button>
                                    </div>

                                    <div id="step1" style="display: none;">
                                        <h2>แบบประเมินสุขภาพ</h2>
                                        <table id="myTable" class="table table-hover my-0 ">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับที่</th>
                                                    <th>แบบประเมิน</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM screening";
                                                $result = mysqli_query($conn, $sql);
                                                $tid = 1;

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $tid . "</td>";
                                                        echo "<td>" . $row["s_question"] . "</td>";
                                                        echo "<td><input type='radio' name='answer_1_" . $tid . "' value='1'> ใช่</td>";
                                                        echo "<td><input type='radio' name='answer_1_" . $tid . "' value='0'> ไม่ใช่</td>";
                                                        $tid++;
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }


                                                mysqli_close($conn);

                                                ?>

                                            </tbody>
                                        </table>
                                        <button class="btn btn-danger mt-3" type="button" id="prev0">ก่อนหน้า</button>
                                        <button class="btn btn-danger mt-3" type="submit" name="screening_submit" onclick="return validateForm()">ยืนยัน</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>โรงพยาบาลตรัง</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // ตรวจสอบการส่งค่าแบบ POST จากฟอร์ม
                            document.querySelector('form').addEventListener('submit', function(event) {
                                event.preventDefault(); // ป้องกันการส่งฟอร์มโดยปกติ

                                // ดึงค่าจากฟอร์มและแสดงใน Console
                                const formData = new FormData(this);
                                for (const pair of formData.entries()) {
                                    console.log(pair[0], pair[1]);
                                }

                                // ส่งข้อมูลแบบ POST ไปยังเซิร์ฟเวอร์
                                fetch('your_server_endpoint.php', {
                                        method: 'POST',
                                        body: formData,
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        console.log(data); // แสดงข้อมูลที่ได้จากการตอบกลับจากเซิร์ฟเวอร์
                                    })
                                    .catch(error => {
                                        console.error('เกิดข้อผิดพลาด:', error);
                                    });
                            });
                        });
                    </script> -->
    <script>
        function fetchUserInfo() {
            // ดึงค่ารหัสผู้บริจาคที่ผู้ใช้ป้อน
            var donorid = document.getElementsByName('donorid')[0].value;

            // ส่งคำร้องขอ AJAX ไปยังไฟล์ PHP ที่จะดึงข้อมูลผู้ใช้
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_user_info.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // แสดงข้อมูลผู้ใช้ที่ได้รับจากเซิร์ฟเวอร์
                    document.getElementById('user-info').value = xhr.responseText; // เปลี่ยน user-info.name เป็น xhr.responseText
                }
            };
            xhr.send("donorid=" + donorid);
        }
    </script>

    <script>
        const form = document.querySelector("#multi-step-form");
        const step0 = document.querySelector("#step0");
        const step1 = document.querySelector("#step1");
        const next0Button = document.querySelector("#next0");
        const prev0Button = document.querySelector("#prev0");
        const next1Button = document.querySelector("#next1");

        next0Button.addEventListener("click", function() {
            // ตรวจสอบว่าทุก input element ใน step0 ถูกป้อนค่าหรือไม่
            const inputs = step0.querySelectorAll("input[required]");
            let allInputsValid = true;

            inputs.forEach(function(input) {
                if (input.value.trim() === "") {
                    allInputsValid = false;
                }
            });

            if (allInputsValid) {
                step0.style.display = "none";
                step1.style.display = "block";
                progressBar.style.width = "33%";
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบทุกช่องก่อนดำเนินการถัดไป'
                });
            }
        });
        prev0Button.addEventListener("click", function() {
            step0.style.display = "block";
            step1.style.display = "none";
            progressBar.style.width = "0%";
        });

        // เปลี่ยน next0Button เป็น submitButton
        var submitButton = document.querySelector('button[name="screening_submit"]');
        submitButton.addEventListener("click", function(event) {
            // ตรวจสอบ radiobutton ที่ถูกเลือกในตารางแบบประเมินสุขภาพ
            var radios = document.querySelectorAll('input[name^="answer_1_"]');
            var checkedCount = 0;

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    checkedCount++;
                }
            }

            // ถ้าไม่มี radiobutton ถูกเลือกหรือไม่ครบ 37 ข้อให้แสดง SweetAlert และยกเลิกการส่งฟอร์ม
            if (checkedCount !== 37) {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณาตอบคำถามทุกข้อในแบบประเมินสุขภาพ (ครบ 37 ข้อ)'
                });
                event.preventDefault(); // ยกเลิกการส่งฟอร์ม
            } else {
                // หากคำตอบถูกต้องทั้งหมดให้ส่งฟอร์มต่อไปยัง oc_process.php
                form.submit(); // ส่งฟอร์มต่อไปยัง oc_process.php
            }
        });
    </script>
    <script>
        // Get the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msg = urlParams.get('msg');

        // Check the status and display the SweetAlert message
        if (status === 'success') {
            Swal.fire({
                title: 'บันทึกข้อมูลสำเร็จ',
                text: msg,
                icon: 'success',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'oc_donor.php';
                    window.location.href = redirectURL;
                }
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'บันทึกข้อมูลสำเร็จ',
                text: msg,
                icon: 'warning',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'oc_donor.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>


</html>