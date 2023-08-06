<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_adminprofile'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];

    $sql = "UPDATE officer SET oc_username='$username',oc_firstname='$firstname',oc_lastname='$lastname',oc_phonenumber='$phonenumber' WHERE OC_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "แก้ไขข้อมูลสำเร็จ";
        header("Location: adminprofile.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
        header("Location: adminprofile.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
   
}
mysqli_close($conn);
header("Location: officer.php");
exit();
