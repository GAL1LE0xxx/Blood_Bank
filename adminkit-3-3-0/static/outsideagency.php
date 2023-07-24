<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยงานภายนอก</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <style>
        #calendar {
            background-color: red;
        }
    </style>
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

                </ul>
            </nav>


            <div class="container overflow-hidden mt-5 ">
                <div class="row gx-5">
                    <div class="col">
                        <form class="form-control" action="oabooking_db.php" method="post">
                            <div class="mt-2">
                                <h3>กรอกข้อมูลการจองคิว</h3>
                            </div>
                            <div class="mb-3 mt-3">
                                <label class="form-label">สถานที่ :</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="สถานที่ที่ต้องการให้ตั้งหน่วยบริจาค">
                            </div>

                            <div class="mb-3 ">
                                <label class="form-label">จำนวนผู้บริจาค :</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="จำนวนผู้บริจาค">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">วันที่ต้องการจอง :</label>
                                <input class="form-control form-control-lg" type="date" name="birthdate" placeholder="" />
                            </div>

                            <div class="row mb-5">

                                <div class="col">
                                    <label class="form-label">ตั้งแต่ :</label>
                                    <input type="time" class="form-control" placeholder="First name" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label class="form-label">ถึง :</label>
                                    <input type="time" class="form-control" placeholder="Last name" aria-label="Last name">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="oaboooking" class="form-control btn btn-danger btn-lg submit px-3 mt-3 mb-3">ยืนยันการจอง</button>
                            </div>
                        </form>
                    </div>

                    <div class="col">
                        <div id='calendar' class="p-3 border bg-light"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th', // ระบุให้ใช้ภาษาไทย
                // ปรับแต่งสไตล์ของปฏิทิน
                viewDidMount: function() {
                    calendarEl.style.backgroundColor = '#FF0000'; // เปลี่ยนสีพื้นหลังเป็นสีแดง
                }
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