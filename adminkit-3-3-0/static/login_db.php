<?php
session_start();
include('connect.php');

if (isset($_POST['login_user'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `officer` WHERE oc_username = '$username'AND oc_password = '$password'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['oc_id'];
    $_SESSION['id'] = $id;
    $position = $row['oc_position'];
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['position'] = $position;
        $position = $row['oc_position']; // Retrieve the oc_position value

        // Check oc_position and redirect accordingly
        if ($position == 0) {
            // Redirect to admin page
            header('location: admin/officer.php');
        } elseif ($position == 1) {
            // Redirect to technicalmed page
            header('location: member.php');
        } 
    } else {
        $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        header('location: login.php');
    }
}

mysqli_close($conn);
?>
