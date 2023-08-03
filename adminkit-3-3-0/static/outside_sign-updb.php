<?php
	include("connect.php");
	session_start();

	if (isset($_POST['singupoutside'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];
		$outsidename = $_POST['outsidename'];
		$outsidedetails = $_POST['outsidedetails'];
		$outsideaddress = $_POST['outsideaddress'];
		$coname = $_POST['coname'];
		$cophone = $_POST['cophone'];
		

		$sql = "SELECT * FROM outsideagency WHERE oa_username = '$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		if ($password != $c_password) {
			$_SESSION['errors'] = "รหัสผ่านไม่ตรงกัน";
		} else if ($row) {
			if ($row['oa_username'] === $username) {
				$_SESSION['errors'] = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
			}
		} else {
			$encryptpassword = md5($password);
			$sql = "INSERT INTO outsideagency (oa_username,oa_password,oa_name,oa_details,oa_address,oa_coname,oa_cophone) VALUES ('$username','$encryptpassword','$outsidename','$outsidedetails','$outsideaddress','$coname','$cophone')";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['success'] = "เพิ่มผู้ใช้สำเร็จ";
			} else {
				$_SESSION['errors'] = "เพิ่มผู้ใช้ไม่สำเร็จ";
			}
		}
		mysqli_close($conn);
		header('location:outside_sign-up.php');
		exit();
	}
	mysqli_close($conn);
