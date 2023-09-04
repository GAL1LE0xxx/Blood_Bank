<?php
include "../connect.php";
session_start();

if (isset($_POST['add_screening'])) {

    $question = $_POST['question'];

    $sql = "INSERT INTO screening (s_question) VALUE ($question)";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "เพิ่มข้อมูลสำเร็จ";
        header("Location: screening.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "เพิ่มข้อมูลไม่สำเร็จ";
        header("Location: screening_add.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}
mysqli_close($conn);
header('location: screening.php');
