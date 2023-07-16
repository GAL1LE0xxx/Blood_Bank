<?php
	include("connect.php");
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

		$sql = "SELECT * FROM donor WHERE dn_usenername = '$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		if ($password != $c_password) {
			$_SESSION['errors'] = "รหัสผ่านไม่ตรงกัน";
		} else if ($row) {
			if ($row['dn_username'] === $username) {
				$_SESSION['errors'] = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
			}
		} else {
			$encryptpassword = md5($password);
			$sql = "INSERT INTO donor (dn_username,dn_password,dn_name,dn_persernalid,dn_gender,dn_email,dn_address,dn_phonenumber,dn_birthdate) VALUES ('$username','$encryptpassword','$name','$persernalid','$gender','$email','$address','$phonenumber','$birthdate')";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['success'] = "เพิ่มผู้ใช้สำเร็จ";
			} else {
				$_SESSION['errors'] = "เพิ่มผู้ใช้ไม่สำเร็จ";
			}
		}
		mysqli_close($conn);
		header('location: member.php');
	}
	mysqli_close($conn);
