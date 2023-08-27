<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_specificblood'])) {
    $sbblood = $_POST['sbblood'];
    $id = $_POST['sb_id'];

    $sql = "UPDATE specificblood SET sb_information='$sbblood' WHERE sb_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "แก้ไขข้อมูลสำเร็จ";
        header("Location: blood.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "แก้ไขข้อมูลไม่สำเร็จ";
        header("Location: blood.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}
mysqli_close($conn);
header('location: blood.php');
