<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_screening'])) {
    $id = $_POST['qid'];
    $question = $_POST['question']; // รับค่าจากฟอร์มด้วย name="question"

    $sql = "UPDATE screening SET s_question='$question' WHERE s_id='$id'";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "แก้ไขข้อมูลสำเร็จ";
        header("Location: screening.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "แก้ไขข้อมูลไม่สำเร็จ";
        header("Location: screening_edit.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}

header('location: screening.php');
mysqli_close($conn);
?>
