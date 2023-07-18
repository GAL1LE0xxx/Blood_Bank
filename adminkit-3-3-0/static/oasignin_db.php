<?php 
session_start();
include('connect.php');

if(isset($_POST['outsidesignin'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM outsideagency WHERE oa_username = '$username' AND oa_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $status = $row['oa_status'];
        $_SESSION['status'] = $status;

        if($status == 0){
            $_SESSION['errors'] = "คุณยังไม่ได้รับการอนุมัติจากเจ้าหน้าที่";
            header('location: oasign-in.php');
            exit;
        }elseif($status == 1){
            header('Location: outsideagency.php');
            exit;
        }elseif($status == 2){
            $_SESSION['errors'] = "คุณไม่ได้รับอนุมัติจากเจ้าหน้าที่";
            header('location: oasign-in.php');
            exit;
        }
    }else{
        $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        header('location: oasign-in.php');
    }
}
mysqli_close($conn);
?>
