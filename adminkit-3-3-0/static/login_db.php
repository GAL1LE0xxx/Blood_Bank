<?php
session_start();
include('connect.php');

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM officer WHERE oc_username = '$username' AND oc_password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['position'] = $row['oc_position']; // Assign oc_position value to the session variable

        // Check oc_position and redirect accordingly
        if ($_SESSION['position'] == 0) {
            // Stay on the current page and wait for 1 second
            echo '<script>
                setTimeout(function() {
                    location.href = "officer.php";
                }, 1000);
                alert("เข้าสู่ระบบเรียบร้อยแล้ว กำลังเปลี่ยนเส้นทางไปยังหน้า admin...");
            </script>';
        } elseif ($_SESSION['position'] == 1) {
            // Stay on the current page and wait for 1 second
            echo '<script>
                setTimeout(function() {
                    location.href = "member.php";
                }, 1000);
                alert("เข้าสู่ระบบเรียบร้อยแล้ว กำลังเปลี่ยนเส้นทางไปยังหน้า technicalmed...");
            </script>';
        }
        exit(); // Exit after redirection
    } else {
        $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        // Stay on the current page and wait for 1 second
        header('Location: login.php');
        exit(); // Exit after redirection
    }
}

mysqli_close($conn);
?>
