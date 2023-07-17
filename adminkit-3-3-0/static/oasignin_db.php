<?php
session_start();
include('connect.php');

if (isset($_POST['outsidesignin'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM outsideagency WHERE oa_username = '$username' AND oa_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $row = mysqli_fetch_assoc($result);
            $_SESSION['status'] = $row['oa_status'];

            if ($_SESSION['status'] == 0) {
                header('Location: outsideagency.php');
                exit;
            }
        } else {
            $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header('Location: oasign-in.php');
        }
    } else {
        echo 'ข้อผิดพลาดในการดึงข้อมูล: ' . mysqli_error($conn);
    }
}
?>
