<?php
include "../connect.php";
session_start();

if (!isset($_SESSION['username'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: oasign-in.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['username'];
$sql = "SELECT * FROM outsideagency WHERE oa_username = '$user'";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['oa_id'];
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
                                    <input class="form-control form-control-lg" type="date" name="bookingdate" placeholder="" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="bookingtime">ช่วงเวลา :</label>
                                    <select class="form-select form-control-lg" aria-label="Default select example" name="bookingtime" required>
                                        <option value="08.30 - 09.00 น." selected>08.30 - 09.00 น.</option>
                                        <option value="09.00 - 10.00 น.">09.00 - 10.00 น.</option>
                                        <option value="10.05 - 11.00 น.">10.05 - 11.00 น.</option>
                                        <option value="11.05 - 12.00 น.">11.05 - 12.00 น.</option>
                                        <option value="12.05 - 13.00 น.">12.05 - 13.00 น.</option>
                                        <option value="13.05 - 14.00 น.">13.05 - 14.00 น.</option>
                                        <option value="14.05 - 15.00 น.">14.05 - 15.00 น.</option>
                                        <option value="15.05 - 15.30 น.">15.05 - 15.30 น.</option>
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
                        `<div class="p-2">
                      <div class="d-flex">
                              <i class="fa-solid fa-user pe-2"></i>
                              <div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">ถูกจองแล้ว ` +
                        `</div>
                  </div>`;
                    return {
                        html: html
                    };
                },

                dateClick: function(info) {
                    moment.locale('th');
                    var selectedDate = info.dateStr;
                    var formattedDate = moment(selectedDate).format("DD MMMM YYYY");
                    // Show the Form Modal
                    $('#formModal').modal('show');
                    // Set the selected date in the form
                    $('#exampleFormControlTextarea1').val(formattedDate);
                    $('#hidden').val(selectedDate);
                },
            });

            calendar.render();
        });
    </script>



    <style>
        #calendar {
            background-color: white !important;
            /* เปลี่ยนสีพื้นหลังเป็นสีแดง */
        }
    </style>


</body>

</html>