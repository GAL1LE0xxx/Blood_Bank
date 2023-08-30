<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_wdonate'])) {
	$id = $_POST['wd_id'];
	$donateday = $_POST['donateday'];
	$amount = $_POST['amount'];
	$donorid = $_POST['donorid'];
	$status = $_POST['status'];

	$sql = "UPDATE wholedonation SET wd_date='$donateday', wd_amount='$amount',dn_id='$donorid',wd_status='$status' WHERE wd_id='$id'";

	if (mysqli_query($conn, $sql)) {
		$successMessage = "แก้ไขข้อมูลสำเร็จ";
		header("Location: wdonate_edit.php?status=success&msg=" . urlencode($successMessage));
		exit();
	} else {
		$errorMessage = "แก้ไขข้อมูลไม่สำเร็จ";
		header("Location: wdonate_edit.php?status=error&msg=" . urlencode($errorMessage));
		exit();
	}
}
header('location: blooddonate.php');
mysqli_close($conn);
