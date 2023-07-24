<?php
    include("connect.php");
    session_start();

    if (isset($_POST['add_news'])) {
        $topic = $_POST['topic'];
        $details = $_POST['details'];

        // จัดการการอัปโหลดไฟล์
        $targetDir = "uploads/"; // ไดเรกทอรี่ที่คุณต้องการเก็บรูปภาพที่อัปโหลด
        $fileName = $_FILES['picture']['name'];
        $targetPath = $targetDir . $fileName;

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE) {
            // ไม่มีไฟล์ภาพที่อัปโหลด ใช้รูปภาพเริ่มต้นแทน
            $targetPath = "uploads/default_image.jpg";
        } else {
            // มีไฟล์ภาพที่อัปโหลด ย้ายไฟล์ไปยังโฟลเดอร์เป้าหมาย
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
                // การอัปโหลดไฟล์ภาพสำเร็จ แทรกที่อยู่ของรูปภาพลงในฐานข้อมูล
                $sql = "INSERT INTO publicrelations (pr_topic, pr_details, pr_image, pr_date) VALUES ('$topic', '$details', '$targetPath', current_timestamp())";
                if (mysqli_query($conn, $sql)) {
                    $response = array(
                        "status" => "success",
                        "msg" => "อัพโหลดข้อมูลสำเร็จ"
                    );
                    $successMessage = "อัพโหลดข้อมูลสำเร็จ";
                        header("Location: pr_add.php?status=success&msg=" . urlencode($successMessage));
                        exit();
                } else {
                    // Return a response indicating an error if there's an issue with moving the uploaded file
                    $response = array(
                        "status" => "error",
                        "msg" => "ไฟล์อัปโหลดไม่ถูกต้อง"
                    );
                      // Display error message and redirect to order.php
                      $errorMessage = "ไฟล์อัปโหลดไม่ถูกต้อง";
                      header("Location: pr_add.php?status=error&msg=" . urlencode($errorMessage));
                      exit();
                }
            }else {
               
                $response = array(
                    "status" => "error",
                    "msg" => "เกิดข้อผิดพลาดกรุณาอัพโหลดใหม่อีกครั้ง"
                );
                  // Display error message and redirect to order.php
                  $errorMessage = "เกิดข้อผิดพลาดกรุณาอัพโหลดใหม่อีกครั้ง";
                  header("Location: pr_add.php?status=error&msg=" . urlencode($errorMessage));
                  exit();
            }
            echo json_encode($response);
        }
    }
        
?>