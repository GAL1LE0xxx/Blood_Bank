<?php
include("../connect.php");
session_start();

if (isset($_POST['add_sbloodtype'])) {
    $sbblood = $_POST['sinformation'];

    $sql = "SELECT * FROM specificblood WHERE sb_information = '$sbblood'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO specificblood (sb_information) VALUES ('$sbblood')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "เพิ่มข้อมูลสำเร็จ";
    } else {
        $_SESSION['errors'] = "เพิ่มข้อมูลไม่สำเร็จ";
    }

    mysqli_close($conn);
    header('location: blood.php');
}
?>
