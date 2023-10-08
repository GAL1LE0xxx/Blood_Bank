<?php
// เชื่อมต่อฐานข้อมูล
include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['screeningedit_submit'])) {
    // รับค่าที่ส่งมาจากแบบฟอร์ม
    $dn_id = $_POST['dn_id'];
    $pressure = $_POST['pressure'];
    $pulse = $_POST['pulse'];
    $hb = $_POST['hb'];
    $temperature = $_POST['temperature'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    // ทำคำสั่ง SQL เพื่ออัพเดทข้อมูลในฐานข้อมูล
    $sql = "UPDATE healthresults SET hr_pressure = '$pressure', hr_pulse = '$pulse', hr_hb = '$hb', hr_temperature = '$temperature', hr_weight = '$weight', hr_height = '$height' WHERE dn_id = '$dn_id' AND DATE(hr_date) = CURDATE()";

    if ($conn->query($sql) === TRUE) {
        // อัพเดทข้อมูลสำเร็จ
        $successMessage = "อัพเดทข้อมูลสำเร็จ";
        header("Location: edit_donor.php?status=success&msg=" . urlencode($successMessage));
    } else {
        // เกิดข้อผิดพลาดในการอัพเดทข้อมูล
        $errorMessage = "เกิดข้อผิดพลาดในการอัพเดทข้อมูล: " . $conn->error;
        header("Location: edit_donor.php?status=error&msg=" . urlencode($errorMessage));
    }
} else {
    // กรณีที่ไม่มีการส่งข้อมูลหรือไม่มีการกดปุ่ม "ยืนยัน"
    echo "ไม่พบการส่งข้อมูลหรือไม่มีการกดปุ่มยืนยัน";
}
?>
