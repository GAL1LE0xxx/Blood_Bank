<?php
session_start();
include('connect.php');

if (isset($_POST['login_user'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM officer WHERE oc_username = '$username'AND oc_password = '$password'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['oc_id'];
        $_SESSION['id'] = $id;
        $position = $row['oc_position'];
        $_SESSION['position'] = $position;
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['position'] = $position;
        // Retrieve the oc_position value

        // Check oc_position and redirect accordingly
        if ($position == 0) {
            // Redirect to admin page
            $successMessage = "เข้าสู่ระบบสำเร็จยินดีต้อนรับ $username";
            header("location: admin/officer.php?status=success&msg=" . urlencode($successMessage));
            exit();
        } elseif ($position == 1) {
            // Redirect to technicalmed page
            $successMessage = "เข้าสู่ระบบสำเร็จยินดีต้อนรับ $username";
            header("location: officer/member.php?status=success&msg=" . urlencode($successMessage));
        }
    } else {
        $errorMessage = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header("location: login.php?status=error&msg=" . urlencode($errorMessage));

    }
}

mysqli_close($conn);
