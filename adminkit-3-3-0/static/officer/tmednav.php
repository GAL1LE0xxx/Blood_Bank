<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center flex-column" href="../home.php">
                <img width="60" height="60" src="..\img\photos\logo.png" alt="logo">
                <span class="align-middle">ธนาคารเลือด</span>
                <span class="align-middle">โรงพยาบาลตรัง</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    จัดการข้อมูล
                </li>

                <li class="sidebar-item ">
                    <a class="sidebar-link" href="member.php">
                        <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">จัดการข้อมูลสมาชิก</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a class="sidebar-link" href="booking_ap.php">
                        <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">อนุมัติการจองคิว</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a class="sidebar-link" href="blooddonate.php">
                        <i class="align-middle" data-feather="droplet"></i> <span class="align-middle">จัดการข้อมูลการบริจาคโลหิต</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a class="sidebar-link" href="oc_donor.php">
                        <i class="align-middle" data-feather="droplet"></i> <span class="align-middle">บันทึกแบบคัดกรองเบื้องต้น</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    รายงาน
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link dropdown-toggle" data-toggle="collapse" data-target="#donor-dropdown">
                        <i class="align-middle" data-feather="bar-chart-2"></i>
                        <span class="align-middle">ข้อมูลและจำนวนผู้บริจาค</span>
                    </a>
                    <div class="collapse" id="donor-dropdown">
                        <ul class="sidebar-sub">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="wbdonordat_report.php">
                                    <span class="align-middle">ประเภทของโลหิตรวม</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="sbdonordat_report.php">
                                    <span class="align-middle">ประเภทของโลหิตเฉพาะส่วน</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="timedonordat_report.php">
                                    <span class="align-middle">ข้อมูลตามช่วงเวลา</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="gendonordat_report.php">
                                    <span class="align-middle">ข้อมูลตามเพศ</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="agedonordat_report.php">
                                    <span class="align-middle">ข้อมูลตามช่วงอายุ</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="sub_page2.php">
                                    <span class="align-middle">ข้อมูลจํานวนครั้งของการบริจาค</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link dropdown-toggle" data-toggle="collapse" data-target="#book-dropdown">
                        <i class="align-middle" data-feather="bar-chart-2"></i>
                        <span class="align-middle">ข้อมูลการจองคิว</span>
                    </a>
                    <div class="collapse" id="book-dropdown">
                        <ul class="sidebar-sub">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="dnbooking_report.php">
                                    <span class="align-middle">ผู้บริจาค</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="oabooking_report.php">
                                    <span class="align-middle">หน่วยงานภายนอก</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link dropdown-toggle" data-toggle="collapse" data-target="#am-dropdown">
                        <i class="align-middle" data-feather="bar-chart-2"></i>
                        <span class="align-middle">ข้อมูลปริมาณโลหิต</span>
                    </a>
                    <div class="collapse" id="am-dropdown">
                        <ul class="sidebar-sub">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="wbamout_report.php">
                                    <span class="align-middle">ประเภทของโลหิตรวม</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="sbamout_report.php">
                                    <span class="align-middle">ประเภทของโลหิตเฉพาะส่วน</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link dropdown-toggle" data-toggle="collapse" data-target="#bloodstatus-dropdown">
                        <i class="align-middle" data-feather="bar-chart-2"></i>
                        <span class="align-middle">ข้อมูลสถานะโลหิต</span>
                    </a>
                    <div class="collapse" id="bloodstatus-dropdown">
                        <ul class="sidebar-sub">
                            <li class="sidebar-item">
                                <a class="sidebar-link " href="wbbloodstatus_report.php">
                                    <span class="align-middle">ข้อมูลสถานะโลหิตรวม</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="sbbloodstatus_report.php">
                                    <span class="align-middle">ข้อมูลสถานะโลหิตเฉพาะส่วน</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="icons-feather.html">
                        <i class="align-middle" data-feather=""></i> <span class="align-middle"></span>
                    </a>
                </li>

                <li class="sidebar-header">
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="charts-chartjs.html">
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="maps-google.html">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <script>
        $(document).ready(function() {
            // ค้นหา URL ปัจจุบันของหน้า
            var currentUrl = window.location.pathname;

            // อ่านค่า 'activeMenu' จาก Local Storage (หากมี)
            var activeMenu = localStorage.getItem('activeMenu');

            // หาคลาส 'active' และลบออกจาก <li> ทั้งหมดในเมนู
            $(".sidebar-item").removeClass("active");

            // ถ้ามีค่า 'activeMenu' ใน Local Storage ใช้ค่านี้เป็น URL ปัจจุบัน
            if (activeMenu) {
                currentUrl = activeMenu;
            }

            // หา <a> ที่มี href ตรงกับ URL ปัจจุบันและเพิ่มคลาส 'active' ให้กับ <li> ที่ครอบอยู่
            $(".sidebar-link[href='" + currentUrl + "']").parent().addClass("active");

            // เมื่อคลิกที่เมนู
            $(".sidebar-link").click(function() {
                // ลบคลาส 'active' จากทุก <li> ในเมนู
                $(".sidebar-item").removeClass("active");

                // เพิ่มคลาส 'active' ไปยัง <li> ที่คลิก
                $(this).parent().addClass("active");

                // บันทึกสถานะเมนูที่เลือกลงใน Local Storage
                localStorage.setItem('activeMenu', $(this).attr('href'));
            });
        });
    </script>
</body>

</html>