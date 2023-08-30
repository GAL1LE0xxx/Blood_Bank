<?php
include("../connect.php");
session_start();

if (isset($_POST['edit_oa'])) {
    $id = $_POST['oa_id'];
    $username = $_POST['username'];
    $outsidename = $_POST['outsidename'];
    $outsidedetails = $_POST['outsidedetails'];
    $outsideaddress = $_POST['outsideaddress'];
    $coname = $_POST['coname'];
    $cophone = $_POST['cophone'];

    $sql = "UPDATE outsideagency SET oa_username='$username', oa_name='$name', oa_details='$outsidedetails',oa_address='$outsideaddress',oa_coname='$coname',oa_cophone='$cophone', WHERE oa_id='$id'";

    if (mysqli_query($conn, $sql)) {
        $successMessage = "แก้ไขผู้ใช้สำเร็จ";
        header("Location: oa_edit.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {

        $errorMessage = "แก้ไขผู้ใช้ไม่สำเร็จ";
        header("Location: oa_edit.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}
header('location: member.php');
mysqli_close($conn);
