<?php
    include("connect.php");
    session_start();
    
    if (isset($_POST['add_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phonenumber= $_POST['phonenumber'];
        $position = $_POST['position'];
        $sql = "SELECT * FROM user WHERE oc_username = '$username' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($password!=$password2){
            $_SESSION['errors'] = "รหัสผ่านไม่ตรงกัน";
        }elseif ($row) {  //ถ้ามีผู้ใช้ในระบบ
            if ($row['oc_username']===$username) {
                $_SESSION['errors'] = "มีชื่อผู้ใช้นี้ในระบบแล้ว";   
            }
        }else {
            $encryptpassword = md5($password);
            $sql = "INSERT INTO officer (oc_username,oc_password,oc_firstname,oc_lastname,oc_phonenumber,oc_position) VALUES ('$username','$encryptpassword','$firstname','$lastname','$phonenumber','$position')";
            if(mysqli_query($conn,$sql)) {
                $_SESSION['success'] = "เพิ่มผู้ใช้สำเร็จ";
            } else {
                $_SESSION['errors'] = "เพิ่มผู้ใช้ไม่สำเร็จ";
            }
        }
        mysqli_close($conn);
        header('location: user_add.php');
    }
    mysqli_close($conn);
?>