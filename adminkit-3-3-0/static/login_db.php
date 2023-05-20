<?php
    
    session_start();
    include('connect.php');
    if(isset($_POST['login_user'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM officer WHERE oc_username = '$username' AND oc_password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            echo mysqli_num_rows($result);
            header('location: officer.php');
        } else {
            $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header('location: login.php');
        }
    }
    mysqli_close($conn);
?>
