<?php 
session_start();
include('../connect.php');

if(isset($_POST['outsidesignin'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM outsideagency WHERE oa_username = '$username' AND oa_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $id = $row['oa_id'];
        $name = $row['oa_name'];
        $_SESSION['id'] = $id;     
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $status = $row['oa_status'];
        $_SESSION['status'] = $status;

        if($status == 0){
            $errorMessage ="กรุณารอเจ้าหน้าทำการอนุมัติการสมัครสมาชิก";
            header("location: oasign-in.php?status=error&msg=" .     urlencode($errorMessage));
            exit;
        }elseif($status == 1){
            $successMessage = "เข้าสู่ระบบสำเร็จยินดีต้อนรับ $username";
            header("location: oamenu.php?status=success&msg=" . urlencode($successMessage));
            exit;
        }elseif($status == 2){
            $errorMessage ="คุณไม่ได้รับอนุมัติการสมัครสมาชิกจากเจ้าหน้าที่";
            header("location: oasign-in.php?status=error&msg=" . urlencode($errorMessage));
            exit;
        }
    }else{
        $errorMessage = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header("location: oasign-in.php?status=error&msg=" . urlencode($errorMessage));
            exit;
    }
}
mysqli_close($conn);
?>
