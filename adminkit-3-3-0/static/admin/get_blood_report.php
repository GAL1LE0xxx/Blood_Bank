<?php
// เชื่อมต่อฐานข้อมูล
include('../connect.php');

// รับค่าเดือนและปีที่ผู้ใช้เลือกจาก AJAX
$selectedMonth = $_POST['month'];
$selectedYear = $_POST['year'];

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลปริมาณโลหิตตามเดือนและปีที่เลือก
$query = "SELECT wb.wb_id, SUM(wh.wd_amount) AS total_wd_amount
    FROM wholedonation wh
    INNER JOIN donor d ON wh.dn_id = d.dn_id
    INNER JOIN wholeblood wb ON d.wb_id = wb.wb_id
    WHERE MONTH(wh.wd_date) = $selectedMonth AND YEAR(wh.wd_date) = $selectedYear
    GROUP BY wb.wb_id";

$result = mysqli_query($conn, $query);

if ($result === false) {
    die("การสอบถามผิดพลาด: " . mysqli_error($conn));
}

// กำหนดค่าเริ่มต้นสำหรับรายงานปริมาณโลหิต
$total_wd_amount = 0;
$count = 0;

// สร้าง HTML สำหรับแสดงข้อมูล
$html = '<div class="row">';
while ($row = mysqli_fetch_assoc($result)) {
    $total_wd_amount += $row['total_wd_amount'];
    $count++;

    // เพิ่มข้อมูลแต่ละหมวดหมู่เลือด
    $html .= '
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">ปริมาณโลหิตรายหมวดหมู่</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-danger">
                                ' . $row['wb_id'] . '<i class="bi bi-droplet-half"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">' . $row['total_wd_amount'] . ' มิลลิลิตร </h1>
                </div>
            </div>
        </div>';
}

$html .= '</div>';

// ส่ง HTML กลับไปยังหน้าเว็บ
echo $html;

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
