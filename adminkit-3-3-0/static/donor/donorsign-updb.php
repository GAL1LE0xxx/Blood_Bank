<?php
include("../connect.php");
session_start();

if (isset($_POST['singupuser'])) {
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

	$sql = "SELECT * FROM donor WHERE dn_usenername = '$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($password != $c_password) {
		$errorMessage = "รหัสผ่านไม่ตรงกัน";
		header("Location: donorsign-up.php?status=error&msg=" . urlencode($errorMessage));
		exit();
	} else if ($row) {
		if ($row['oc_username'] === $username) {
			$errorMessage = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
			header("Location: donorsign-up.php?status=error&msg=" . urlencode($errorMessage));
			exit();
		}
	} else {
		$encryptpassword = md5($password);
		$sql = "INSERT INTO donor (dn_username,dn_password,dn_name,dn_persernalid,dn_gender,dn_email,dn_address,dn_phonenumber,dn_birthdate) VALUES ('$username','$encryptpassword','$name','$persernalid','$gender','$email','$address','$phonenumber','$birthdate')";
		if (mysqli_query($conn, $sql)) {
			$successMessage = "ลงทะเบียนสำเร็จ";
			header("Location: donorsign-up.php?status=success&msg=" . urlencode($successMessage));
			exit();
		} else {
			$errorMessage = "ลงทะเบียนไม่สำเร็จ";
			header("Location: donorsign-up.php?status=error&msg=" . urlencode($errorMessage));
			exit();
		}
	}
	mysqli_close($conn);
	header('location: home.php');
}
mysqli_close($conn);
