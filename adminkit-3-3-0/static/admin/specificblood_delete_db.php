<?php
include("../connect.php");
session_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];
    $sql = "DELETE FROM specificblood WHERE sb_id='$id'";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "ลบข้อมูลสำเร็จ";
        header("Location: blood.php?status=success&msg=" . urlencode($successMessage));
        exit();

    } else {
        $errorMessage = "ลบข้อมูลไม่สำเร็จ";
        header("Location: blood.php?status=error&msg=" . urlencode($errorMessage));
        exit();

    }
}
header('location: blood.php');
mysqli_close($conn);
