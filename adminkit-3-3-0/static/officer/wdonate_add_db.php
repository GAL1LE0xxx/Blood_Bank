<?php
include("../connect.php");
session_start();

if (isset($_POST['add_wdonate'])) {
    $donorid = $_POST['donorid'];
	$donateday = $_POST['donateday'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO wholedonation (wd_date,wd_amount,dn_id) VALUES ('$donateday','$amount','$donorid')";
	if (mysqli_query($conn, $sql)) {
        $successMessage = "เพิ่มข้อมูลสำเร็จ";
        header("Location: wdonate_add.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "เพิ่มข้อมูลไม่สำเร็จ";
        header("Location: wdonate_add.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }

}

?>