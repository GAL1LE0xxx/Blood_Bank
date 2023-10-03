<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$name = $_SESSION['name'];
$user = $_SESSION['username'];
$sql = "SELECT * FROM outsideagency WHERE oa_username = '$user' , oa_name ='$name'";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['oa_id'];
}

if (isset($_POST['out_start'])) {
    $searchKeyword = $_POST['out_start'];

    // สร้างคำสั่ง SQL สำหรับการค้นหาข้อมูลจากทั้ง 2 ตาราง
    $sql = "SELECT o.*, os.* FROM outsideagency o
            INNER JOIN outsiteservice os ON o.oa_id = os.oa_id
            WHERE os.out_start LIKE '%$searchKeyword%' AND o.oa_id = '$id'";

    // ประมวลผลคำสั่ง SQL
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยงานภายนอก</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>



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
                            <a class="dropdown-item" href="outsideprofile.php"><i class="align-middle me-1" data-feather="user"></i>บัญชีผู้ใช้</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php">ออกจากระบบ</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="container overflow-hidden mt-5 ">
                <a class="btn btn-danger mt-3 mb-3" href="oamenu.php">ย้อนกลับ</a>
                <div class="row gx-5">
                    <div class="col">
                        <form class="form-control" action="oabooking_db.php" method="post">
                            <div class="mt-2">
                                <h3>กรอกข้อมูลการจองคิว</h3>
                            </div>
                            <input type="hidden" class="form-control form-control-lg" id="id" name="id" value="<?php echo $id ?>">

                            <div class="mb-3 mt-3">
                                <label class="form-label">สถานที่ :</label>
                                <input type="text" class="form-control form-control-lg" id="location" name="location" placeholder="สถานที่ที่ต้องการให้ตั้งหน่วยบริจาค" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">จำนวนผู้บริจาค :</label>
                                <input type="text" class="form-control form-control-lg" id="numberdonor" name="numberdonor" placeholder="จำนวนผู้บริจาค" required>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">วันที่ต้องการจอง :</label>
                                    <input class="form-control form-control-lg" type="date" name="bookingdate" placeholder="" required min="<?php echo date('Y-m-d', strtotime('+1 month')); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"   or="bookingtime">ช่วงเวลา :</label>
                                    <select class="form-select  form-control-lg" aria-label="Default select example" name="bookingtime" required>
                                        <option disabled selec  ed>กรุณาเลือกช่วงเวลา</option>
                                        <option value="ช่วงเช้า"  ช่วงเช้า</option>
                                        <option value="ช่วงบ่าย">ช่วงบ่าย</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="oabooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                            </div>
                        </form>
                    </div>

                    <div class="card mt-3">
                        <div id='calendar' class="p-3 border bg-light "></div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        // Get the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msg = urlParams.get('msg');

        // Check the status and display the SweetAlert message
        if (status === 'success') {
            Swal.fire({
                title: 'success',
                text: msg,
                icon: 'success',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'outsideagency.php';
                    window.location.href = redirectURL;
                }
            });
        } else if (status === 'error') {
            Swal.fire({
                title: msg,
                text: msg,
                icon: 'error',
                confirmButtonClass: 'btn btn-primary'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to order.php with success status and message
                    const redirectURL = 'outsideagency.php';
                    window.location.href = redirectURL;
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/th.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                timeZone: 'Asia/Bangkok',
                initialView: 'dayGridMonth',
                height: 700,
                events: 'fetchEvents.php',
                schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                selectable: false,

                eventContent: (info) => {
                    let html =
                        `<div class="p-2 bg-danger">
                      <div class="d-flex bg-danger">
                              <i class="fa-solid fa-user pe-2 "></i>
                              <div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">ถูกจองแล้วโดย <?php echo $_SESSION['name']; ?>` +
                        `</div>
                  </div>`;
                    return {
                        html: html
                    };
                },
                // dateClick event
                dateClick: function(info) {
                    moment.locale('th');

                    var selectedDate = moment(info.date).format('DD MMMM YYYY');
                    var eventDetails = selectedDate;


                    // Update the event modal content
                    document.getElementById('eventDetails').innerHTML = eventDetails;

                    // Show the event modal
                    $('#eventModal').modal('show');

                },
            });

            calendar.render();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        #calendar {
            background-color: white !important;
            /* เปลี่ยนสีพื้นหลังเป็นสีแดง */
        }
    </style>


</body>

</html>