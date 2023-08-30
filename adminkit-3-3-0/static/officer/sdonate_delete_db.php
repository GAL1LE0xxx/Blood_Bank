<?php
include("../connect.php");
session_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];
    $sql = "DELETE FROM specificdonation WHERE sd_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $successMessage = "ลบข้อมูลสำเร็จ";
			header("Location: blooddonate.php?status=success&msg=" . urlencode($successMessage));
			exit();
    } else {
        $errorMessage = "ลบข้อมูลไม่สำเร็จ";
			header("Location: blooddonate.php?status=error&msg=" . urlencode($errorMessage));
			exit();
    }
}

mysqli_close($conn);
header('Location: blooddonate.php');
exit();
?>
