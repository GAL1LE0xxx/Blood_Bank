<?php
include("../connect.php");
session_start();

if (isset($_POST['add_member'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$c_password = $_POST['c_password'];
	$name = $_POST['name'];
	$persernalid = $_POST['persernalid'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phonenumber = $_POST['phonenumber'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];

	$sql = "SELECT * FROM donor WHERE dn_username = '$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($password != $c_password) {
		$errorMessage = "รหัสผ่านไม่ตรงกัน";
		header("Location: member_add.php?status=error&msg=" . urlencode($errorMessage));
		exit();
	} else if ($row) {
		if ($row['dn_username'] === $username) {
			$errorMessage = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
			header("Location: member_add.php?status=error&msg=" . urlencode($errorMessage));
			exit();
		}
	} else {
		$encryptpassword = md5($password);
		$sql = "INSERT INTO donor (dn_username,dn_password,dn_name,dn_persernalid,dn_gender,dn_email,dn_address,dn_phonenumber,dn_birthdate) VALUES ('$username','$encryptpassword','$name','$persernalid','$gender','$email','$address','$phonenumber','$birthdate')";
		if (mysqli_query($conn, $sql)) {
			$successMessage = "เพิ่มผู้ใช้สำเร็จ";
			header("Location: member_add.php?status=success&msg=" . urlencode($successMessage));
			exit();
		} else {
			$errorMessage = "เพิ่มผู้ใช้ไม่สำเร็จ";
			header("Location: member_add.php?status=error&msg=" . urlencode($errorMessage));
			exit();
		}
	}
	mysqli_close($conn);
	header('location: member.php');
}
mysqli_close($conn);
