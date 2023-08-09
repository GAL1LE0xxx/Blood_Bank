<?php
include("connect.php");
session_start();

if (isset($_POST['edit_oaprofile'])) {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$outsidename = $_POST['outsidename'];
	$outsidedetails = $_POST['outsidedetails'];
	$outsideaddress = $_POST['outsideaddress'];
	$coname = $_POST['coname'];
	$cophone = $_POST['cophone'];

	$sql = "UPDATE outsideagency SET oa_username='$username', oa_name='$outsidename', oa_details='$outsidedetails',oa_address='$outsideaddress',oa_coname='$coname',oa_cophone='$cophone' WHERE oa_id='$id'";

	if (mysqli_query($conn, $sql)) {
		$successMessage = "แก้ไขข้อมูลสำเร็จ";
		header("Location: outsideprofile.php?status=success&msg=" . urlencode($successMessage));
		exit();
	} else {
		$errorMessage = "แก้ไขข้อมูลไม่สำเร็จ";
		header("Location: outsideprofile.php?status=error&msg=" . urlencode($errorMessage));
		exit();
	}
}
header('location: outsideprofile.php');
mysqli_close($conn);
exit();
