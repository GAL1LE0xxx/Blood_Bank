<?php 
session_start();
include('connect.php');

if(isset($_POST['donorsignin'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM donor WHERE dn_username = '$username' AND dn_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $id = $row['dn_id'];
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $status = $row['dn_status'];
        $_SESSION['status'] = $status;

        if($status == 0){
            $_SESSION['errors'] = "คุณยังไม่ได้รับการอนุมัติจากเจ้าหน้าที่";
            header('location: donorsign-in.php');
            exit;
        }elseif($status == 1){
            $successMessage = "เข้าสู่ระบบสำเร็จยินดีต้อนรับ $username";
            header("location: donor.php?status=success&msg=" . urlencode($successMessage));
            exit();
        }elseif($status == 2){
            $_SESSION['errors'] = "คุณไม่ได้รับอนุมัติจากเจ้าหน้าที่";
            header('location: donorsign-in.php');
            exit;
        }
    }else{
        $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        header('location: donorsign-in.php');
    }
}
mysqli_close($conn);
?>
