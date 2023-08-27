<?php
include("../connect.php");
session_start();

if (isset($_POST['add_sbloodtype'])) {
    $sbblood = $_POST['sbblood'];

    $sql = "SELECT * FROM specificblood WHERE sb_information = '$sbblood'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO specificblood (sb_information) VALUES ('$sbblood')";
    if (mysqli_query($conn, $sql)) {
        $successMessage = "เพิ่มข้อมูลสำเร็จ";
header("Location: blood.php?status=success&msg=" . urlencode($successMessage));
exit();
    } else {
        $errorMessage = "เพิ่มข้อมูลไม่สำเร็จ";
header("Location: specificblood_add.php?status=error&msg=" . urlencode($errorMessage));
exit();

        $_SESSION['errors'] = "เพิ่มข้อมูลไม่สำเร็จ";
    }

    mysqli_close($conn);
    header('location: blood.php');
}
