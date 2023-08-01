<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_news'])) {
    $id = $_POST['id'];
    $topic = $_POST['topic'];
    $details = $_POST['details'];
    $currentImage = $_POST['current_image']; // รับชื่อรูปภาพปัจจุบันที่อยู่ในฐานข้อมูล

    // ตรวจสอบว่าผู้ใช้เลือกอัปโหลดไฟล์หรือไม่
    $upload_option = isset($_POST["upload_option"]) ? $_POST["upload_option"] : "no";

    if ($upload_option === "yes") {
        // ผู้ใช้เลือกอัปโหลดไฟล์
        // จัดการการอัปโหลดไฟล์ภาพ
        $targetDir = "uploads/"; // ไดเรกทอรี่ที่คุณต้องการเก็บรูปภาพที่อัปโหลด
        $fileName = $_FILES['picture']['name'];
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
            // การอัปโหลดไฟล์ภาพสำเร็จ
            // อัปเดตข้อมูลในฐานข้อมูลโดยรวมข้อมูลใหม่และรูปภาพใหม่
            $sql = "UPDATE publicrelations SET pr_topic='$topic', pr_details='$details', pr_image='$targetPath', pr_date=current_timestamp() WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                $successMessage = "อัปเดตข้อมูลสำเร็จ";
                header("Location: pr_edit.php?status=success&msg=" . urlencode($successMessage));
                exit();
            } else {
                $errorMessage = "อัปเดตข้อมูลไม่สำเร็จ";
                header("Location: pr_edit.php?status=error&msg=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
            header("Location: pr_edit.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        // ผู้ใช้ไม่ต้องการอัปโหลดไฟล์
        // อัปเดตข้อมูลในฐานข้อมูลเฉพาะข้อมูลใหม่ (ไม่รวมรูปภาพ)
        $sql = "UPDATE publicrelations SET pr_topic='$topic', pr_details='$details', pr_image='$currentImage', pr_date=current_timestamp() WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            $successMessage = "อัปเดตข้อมูลสำเร็จ";
            header("Location: pr_edit.php?status=success&msg=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "อัปเดตข้อมูลไม่สำเร็จ";
            header("Location: pr_edit.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    }
}
?>
