<?php
include("connect.php");
session_start();

if (isset($_POST['add_news'])) {
    $topic = $_POST['topic'];
    $details = $_POST['details'];

    // ตรวจสอบว่าผู้ใช้เลือกอัปโหลดไฟล์หรือไม่
    $upload_option = isset($_POST["upload_option"]) ? $_POST["upload_option"] : "no";

    if ($upload_option === "yes") {
        // ผู้ใช้เลือกอัปโหลดไฟล์
        // จัดการการอัปโหลดไฟล์ภาพ
        $targetDir = "uploads/"; // ไดเรกทอรี่ที่คุณต้องการเก็บรูปภาพที่อัปโหลด
        $fileName = $_FILES['picture']['name'];
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
            // การอัปโหลดไฟล์ภาพสำเร็จ แทรกที่อยู่ของรูปภาพลงในฐานข้อมูล
            $sql = "INSERT INTO publicrelations (pr_topic, pr_details, pr_image, pr_date) VALUES ('$topic', '$details', '$targetPath', current_timestamp())";
            if (mysqli_query($conn, $sql)) {
                $successMessage = "อัปโหลดข้อมูลสำเร็จ";
                header("Location: pr_add.php?status=success&msg=" . urlencode($successMessage));
                exit();
            } else {
                $errorMessage = "อัปโหลดข้อมูลไม่สำเร็จ";
                header("Location: pr_add.php?status=error&msg=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
            header("Location: pr_add.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        // ผู้ใช้ไม่ต้องการอัปโหลดไฟล์
        // ให้ใช้ภาพเริ่มต้น
        $targetPath = "uploads/default_image.jpg";

        // แทรกที่อยู่ของรูปภาพเริ่มต้นลงในฐานข้อมูล
        $sql = "INSERT INTO publicrelations (pr_topic, pr_details, pr_image, pr_date) VALUES ('$topic', '$details', '$targetPath', current_timestamp())";
        if (mysqli_query($conn, $sql)) {
            $successMessage = "เพิ่มข้อมูลสำเร็จ";
            header("Location: pr_add.php?status=success&msg=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "เพิ่มข้อมูลไม่สำเร็จ";
            header("Location: pr_add.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    }
}
?>
