<?php
session_start();
include('connect.php');

if (isset($_POST['login_oa'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM outsideagency WHERE oa_username = '$username' AND oa_password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['status'] = $row['oa_status'];
        
        if ($_SESSION['status'] === 0){
            
        }
        header('Location: outsideagency.php');
        exit();
    } else {
        // ข้อมูลไม่ตรงกันในฐานข้อมูล
        $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        header('Location: oasign-in.php');
        exit();
    }
}

mysqli_close($conn);
?>
