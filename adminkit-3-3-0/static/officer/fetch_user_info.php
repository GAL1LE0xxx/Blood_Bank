<?php
include("../connect.php");
session_start();
// ตรวจสอบว่ามีการส่งค่ารหัสผู้บริจาคมาหรือไม่
if (isset($_POST['donorid'])) {

    // ดึงข้อมูลผู้ใช้โดยใช้รหัสผู้บริจาคที่ส่งมาจาก AJAX
    $donorid = $_POST['donorid'];

    // ตรวจสอบฐานข้อมูลและดึงชื่อผู้บริจาค
    $sql = "SELECT dn_name FROM donor WHERE dn_id = '$donorid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ดึงชื่อผู้บริจาค
        $row = $result->fetch_assoc();
        $donorName = $row['dn_name'];

        // ส่งชื่อผู้บริจาคกลับไปยัง JavaScript
        echo $donorName;
    } else {
        echo "ไม่พบข้อมูลผู้บริจาค: $donorid";
    }
}
// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
