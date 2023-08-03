<?php
// pr_edit_db.php
include("../connect.php");
session_start();

if (isset($_POST['edit_news'])) {
    $id = $_POST['id'];
    $topic = $_POST['topic'];
    $details = $_POST['details'];
    $update_image = $_POST['update_image'];

    // ตรวจสอบว่าผู้ใช้เลือกอัปเดตรูปภาพหรือไม่
    if ($update_image === "yes") {
        // ผู้ใช้เลือกอัปโหลดรูปภาพใหม่
        // ตรวจสอบรูปภาพที่อัปโหลดและอัปเดตในฐานข้อมูล
        $targetDir = "../uploads/"; // ไดเรกทอรี่ที่คุณต้องการเก็บรูปภาพที่อัปโหลด
        $fileName = $_FILES['picture']['name'];
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
            // อัปโหลดไฟล์ภาพสำเร็จ และมีการเปลี่ยนแปลงข้อมูลใหม่ที่อัปโหลด
            // อัปเดตข้อมูลลงในฐานข้อมูล
            $sql = "UPDATE publicrelations SET pr_topic = '$topic', pr_details = '$details', pr_image = '$targetPath', pr_date = current_timestamp() WHERE pr_id='$id'";
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
        // ผู้ใช้ไม่ต้องการอัปโหลดรูปภาพใหม่
        // ให้ใช้ภาพเดิม
        // แทรกที่อยู่ของรูปภาพเดิมลงในฐานข้อมูล
        $sql = "UPDATE publicrelations SET pr_topic = '$topic', pr_details = '$details', pr_date = current_timestamp() WHERE pr_id='$id'";
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
