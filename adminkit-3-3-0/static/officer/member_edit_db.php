<?php
	include("connect.php");
	session_start();

	if (isset($_POST['edit_member'])) {
		$id = $_POST['dn_id'];
		$username = $_POST['username'];
		$name = $_POST['name'];
		$persernalid = $_POST['persernalid'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phonenumber = $_POST['phonenumber'];
		$gender = $_POST['gender'];
		$birthdate = $_POST['birthdate'];

			$sql = "UPDATE donor SET dn_username='$username', dn_name='$name',dn_persernalid='$persernalid',dn_gender='$gender',dn_email='$email',dn_address='$address',dn_phonenumber='$phonenumber',dn_birthdate='$birthdate' WHERE dn_id='$id'";

            if(mysqli_query($conn,$sql)) {
                $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
            } else {
                $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
            }
	}
    header('location: member.php');
    mysqli_close($conn);
