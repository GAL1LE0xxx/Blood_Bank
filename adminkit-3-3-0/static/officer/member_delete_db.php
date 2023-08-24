<?php
include("../connect.php");
session_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];
    $sql = "DELETE FROM donor WHERE dn_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $successMessage = "ลบผู้ใช้สำเร็จ";
			header("Location: member.php?status=success&msg=" . urlencode($successMessage));
			exit();
    } else {
        $errorMessage = "ลบผู้ใช้ไม่สำเร็จ";
			header("Location: member.php?status=error&msg=" . urlencode($errorMessage));
			exit();
    }
}

mysqli_close($conn);
header('Location: member.php');
exit();
?>
