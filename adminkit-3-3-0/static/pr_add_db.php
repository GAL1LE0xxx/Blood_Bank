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
                    $_SESSION['success'] = "เพิ่มสำเร็จ";
                } else {
                    $_SESSION['errors'] = "เพิ่มไม่สำเร็จ";
                }
            } else {
                $_SESSION['errors'] = "ไม่สามารถอัปโหลดไฟล์ภาพได้";
            }
        }
    }

    mysqli_close($conn);
    header('location: pr_manage.php');
    ?>
