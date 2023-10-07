<?php
include("../connect.php");
session_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];

    // ตรวจสอบ on_id ที่ถูกลบว่าเป็นของผู้ใช้ที่เข้าสู่ระบบหรือไม่
    $logged_in_dn_id = $_SESSION['id'];

    // คำสั่ง SQL สำหรับเลือก dn_id ของการจองคิวที่จะถูกลบ
    $sql_check_on_id = "SELECT dn_id FROM onsiteservice WHERE on_id = '$id'";
    $result_check_on_id = mysqli_query($conn, $sql_check_on_id);
    
    if ($result_check_on_id) {
        $row = mysqli_fetch_assoc($result_check_on_id);

        if ($row['dn_id'] === $logged_in_dn_id) {
            // ลบข้อมูลจากตาราง onsiteservice
            $sql_onsiteservice = "DELETE FROM onsiteservice WHERE on_id = '$id'";
            if (mysqli_query($conn, $sql_onsiteservice)) {
                $successMessage = "ลบข้อมูลสำเร็จ";
                header("Location: onsiteservice.php?status=success&msg=" . urlencode($successMessage));
                exit();
            } else {
                $errorMessage = "ลบข้อมูล onsiteservice ไม่สำเร็จ: " . mysqli_error($conn);
                header("Location: onsiteservice.php?status=error&msg=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = "ไม่สามารถลบข้อมูลได้: คุณไม่มีสิทธิ์ลบข้อมูลนี้";
            header("Location: onsiteservice.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        $errorMessage = "ไม่พบข้อมูลการจองคิว";
        header("Location: onsiteservice.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}

mysqli_close($conn);
header('Location: onsiteservice.php');
exit();
?>
