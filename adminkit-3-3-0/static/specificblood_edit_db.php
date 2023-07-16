<?php
include("connect.php");
session_start();

if (isset($_POST['edit_specificblood'])) {
    $sbblood = $_POST['sinformation'];
    $id = $_POST['sb_id'];

    $sql = "UPDATE specificblood SET sb_information='$sbblood' WHERE sb_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ";
    } else {
        $_SESSION['errors'] = "แก้ไขข้อมูลไม่สำเร็จ";
    }

    mysqli_close($conn);
    header('location: blood.php');
}
?>
