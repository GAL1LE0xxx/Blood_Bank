<?php 
session_start();
include('../connect.php');

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
        $name = $row['dn_name'];
        $_SESSION['name'] = $name;


        if($status == 0){
            $errorMessage = "คุณยังไม่ได้รับอนุมัติจากเจ้าหน้าที่";
            header("location: donorsign-in.php?status=error&msg=" . urlencode($errorMessage));
            exit;
        }elseif($status == 1){
            $successMessage = "เข้าสู่ระบบสำเร็จยินดีต้อนรับ $username";
            header("location: donormenu.php?status=success&msg=" . urlencode($successMessage));
            exit();
        }elseif($status == 2){
            $errorMessage = "คุณไม่ได้รับอนุมัติจากเจ้าหน้าที่";
            header("location: donorsign-in.php?status=error&msg=" . urlencode($errorMessage));
            exit;
            
        }
    }else{
            $errorMessage = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header("location: donorsign-in.php?status=error&msg=" . urlencode($errorMessage));
            exit;
    }
}
mysqli_close($conn);
