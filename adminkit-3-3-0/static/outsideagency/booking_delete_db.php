<?php
include("../connect.php");
session_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];

    // ตรวจสอบ oa_id ของผู้ใช้ที่เข้าสู่ระบบ
    $logged_in_oa_id = $_SESSION['id'];

    // คำสั่ง SQL สำหรับเลือก oa_id ของเรา
    $sql_check_oa_id = "SELECT oa_id FROM outsiteservice WHERE out_id = '$id'";
    $result_check_oa_id = mysqli_query($conn, $sql_check_oa_id);
    $row = mysqli_fetch_assoc($result_check_oa_id);

    if ($row['oa_id'] == $logged_in_oa_id) {
        // ลบข้อมูลจากตาราง outsiteservice
        $sql_outsiteservice = "DELETE FROM outsiteservice WHERE out_id = '$id'";
        if (mysqli_query($conn, $sql_outsiteservice)) {
            // ลบข้อมูลจากตาราง event
            $sql_event = "DELETE FROM `event` WHERE `event`.`id` = '$id'";
            if (mysqli_query($conn, $sql_event)) {
                $successMessage = "ลบข้อมูลสำเร็จ";
                header("Location: booking_check.php?status=success&msg=" . urlencode($successMessage));
                exit();
            } else {
                $errorMessage = "ลบข้อมูล event ไม่สำเร็จ: " . mysqli_error($conn);
                header("Location: booking_check.php?status=error&msg=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = "ลบข้อมูล outsiteservice ไม่สำเร็จ: " . mysqli_error($conn);
            header("Location: booking_check.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        $errorMessage = "ไม่สามารถลบข้อมูลได้: คุณไม่มีสิทธิ์ลบข้อมูลนี้";
        header("Location: booking_check.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}

mysqli_close($conn);
header('Location: booking_check.php');
exit();
?>
