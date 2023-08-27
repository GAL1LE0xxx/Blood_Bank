<?php
include("../connect.php");
session_start();

if (isset($_POST['add_officer'])) {
    $username = $_POST['oc_username'];
    $password = $_POST['oc_password'];
    $password2 = $_POST['oc_password2'];
    $firstname = $_POST['oc_firstname'];
    $lastname = $_POST['oc_lastname'];
    $phonenumber = $_POST['oc_phonenumber'];
    $position = $_POST['oc_position'];

    $sql = "SELECT * FROM officer WHERE oc_username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($password != $password2) {
        $errorMessage = "รหัสผ่านไม่ตรงกัน";
        header("Location: officer_add.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    } elseif ($row) {  //ถ้ามีผู้ใช้ในระบบ
        if ($row['oc_username'] === $username) {
            $errorMessage = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
            header("Location: officer_add.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        $encryptpassword = md5($password);
        $sql = "INSERT INTO officer (oc_username,oc_password,oc_firstname,oc_lastname,oc_phonenumber,oc_position) VALUES ('$username','$encryptpassword','$firstname','$lastname','$phonenumber','$position')";
        if (mysqli_query($conn, $sql)) {
            $successMessage = "เพิ่มผู้ใช้สำเร็จ";
            header("Location: officer.php?status=success&msg=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "เพิ่มผู้ใช้ไม่สำเร็จ";
            header("Location: officer_add.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    }
    mysqli_close($conn);
}
