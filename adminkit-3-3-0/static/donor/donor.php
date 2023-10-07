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
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a href="../home.php">
                    <img width="60" height="60" src="../img\photos\logo.png" alt="logo">
                </a>
                <span>ธนาคารเลือดโรงพยาบาลตรัง <br> Blood Bank Trang Hospital </span>
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
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
                <div class="container">
                    <div class="container ">
                        <a class="btn btn-danger mb-3" href="donormenu.php">ย้อนกลับ</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card mb-4 ">
                            <div class="card-body">
                                <form id="multi-step-form" action="process.php" method="POST">
                                    <input type="hidden" name="dn_id" value="<?php echo $_SESSION['id']; ?>">
                                    <div id="step0">
                                        <h2 class="text-center mb-4">ข้อแนะนำเตรียมตัวก่อนบริจาคโลหิต</h2>
                                        <p> 1. พักผ่อนให้เพียงพอไม่น้อยกว่า 5 ชั่วโมง หากอยู่ระหว่างรับประทานยารักษาโรค ให้แจ้งแพทย์/พยาบาล</p>
                                        <p> 2. หลีกเลี่ยงการรับประทานอาหารที่มีไขมันสูง เช่น ข้าวขาหมู ข้าวมันไก่ ขนมหวาน ก่อนมาบริจาคโลหิต 6 ชั่วโมง</p>
                                        <p> 3. ก่อนบริจาคเลือด และก่อนเจาะเลือดบริจาคให้ดื่มน้ำ 3-4 แก้ว จะช่วยทำให้โลหิตไหลเวียนดีขึ้น</p>
                                        <p> 4. งดเครื่องดื่มแอลกอฮอล์ งดสูบบุหรี่ทั้งก่อนและหลังบริจาคโลหิต 1 ชั่วโมง</p>
                                        <p> 5. หลังบริจาคเลือด ควรดื่มน้ำให้มากกว่าปกติและรับประทานยาเสริมธาตุเหล็ก วันละ 1 เม็ด หลังอาหารจนหมด เพื่อชดเชยธาตุเหล็กที่สูญเสียไป</p>
                                        <button class="btn btn-danger" type="button" id="next0">ถัดไป</button>
                                    </div>

                                    <div id="step1" style="display: none;">
                                        <h2>แบบประเมินสุขภาพ 1/2</h2>
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
                                        <button class="btn btn-danger mt-3" type="button" id="next1">ถัดไป</button>
                                    </div>
                                    <div id="step2" style="display: none;">
                                        <h2>แบบคัดกรองสุขภาพ</h2>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="pressure">ความดันโลหิต (มิลิ)</label>
                                                <input class="form-control" name="pressure" type="text" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="pulse">ชีพจร</label>
                                                <input class="form-control" name="pulse" type="text" required>
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="hb">ระดับฮีโมโกลบิน</label>
                                                <input class="form-control" name="hb" type="text" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="text mb-1" for="temperature">อุณหภูมิร่างกาย</label>
                                                <input class="form-control" name="temperature" type="text" required>
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="text mb-1" for="weight">น้ำหนัก</label>
                                                <input class="form-control" name="weight" type="text" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="text mb-1" for="height">ส่วนสูง</label>
                                                <input class="form-control" name="height" type="text" required>
                                            </div>
                                        </div>

                                        <button class="btn btn-danger" type="button" id="prev1">ก่อนหน้า</button>

                                        <button class="btn btn-danger" type="submit" name="screening_submit" onclick="return validateForm()">ยืนยัน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="footer">
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
    </div>


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
        const form = document.querySelector("#multi-step-form");
        const step0 = document.querySelector("#step0");
        const step1 = document.querySelector("#step1");
        const step2 = document.querySelector("#step2");
        const step3 = document.querySelector("#step3");
        const next0Button = document.querySelector("#next0");
        const prev0Button = document.querySelector("#prev0");
        const next1Button = document.querySelector("#next1");
        const prev1Button = document.querySelector("#prev1");
        const next2Button = document.querySelector("#next2");
        const prev2Button = document.querySelector("#prev2");
        const progressBar = document.querySelector(".progress-bar");

        next0Button.addEventListener("click", function() {
            step0.style.display = "none";
            step1.style.display = "block";
            progressBar.style.width = "33%";
        });
        prev0Button.addEventListener("click", function() {
            step0.style.display = "block";
            step1.style.display = "none";
            progressBar.style.width = "0%";
        });

        // สำหรับปุ่ม "Next" ในขั้นตอนที่ 1
        next1Button.addEventListener("click", function() {
            // ตรวจสอบ radiobutton ที่ถูกเลือกในตาราง
            var radios = document.querySelectorAll('input[name^="answer_1_"]');
            var checkedCount = 0;

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    checkedCount++;
                }
            }

            // ถ้าไม่มี radiobutton ถูกเลือกหรือไม่ครบ 37 ข้อให้แสดง SweetAlert
            if (checkedCount !== 37) {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณาตอบคำถามทุกข้อในแบบประเมินสุขภาพ (ครบ 37 ข้อ)'
                });
            } else {
                step1.style.display = "none";
                step2.style.display = "block";
                progressBar.style.width = "66%";
            }
        });


        prev1Button.addEventListener("click", function() {
            step1.style.display = "block";
            step2.style.display = "none";
            progressBar.style.width = "33%";
        });

        next2Button.addEventListener("click", function() {
            step2.style.display = "none";
            step3.style.display = "block";
            progressBar.style.width = "100%";
        });

        prev2Button.addEventListener("click", function() {
            step2.style.display = "block";
            step3.style.display = "none";
            progressBar.style.width = "66%";
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
                title: 'Success',
                text: msg,
                icon: 'success',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'donor.php';
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
                    const redirectURL = 'donor.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>

</body>


</html>