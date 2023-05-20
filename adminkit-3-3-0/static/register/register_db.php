<?php
    include("connect.php");
    session_start();
    
    if (isset($_POST['reg_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $sql = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($password!=$password2){
            $_SESSION['errors'] = "รหัสผ่านไม่ตรงกัน";
        }elseif ($row) {  //ถ้ามีผู้ใช้ในระบบ
            if ($row['username']===$username) {
                $_SESSION['errors'] = "มีชื่อผู้ใช้นี้ในระบบแล้ว";   
            }
        }elseif ($row['email']===$email) {
                $_SESSION['errors'] = "มีอีเมลนี้ ($email) ในระบบแล้ว";
        }else {
            $encryptpassword = md5($password);
            $sql = "INSERT INTO user (username,password,firstname,lastname,email,gender,birthdate) VALUES ('$username','$encryptpassword','$firstname','$lastname','$email','$gender','$birthdate')";
            if(mysqli_query($conn,$sql)) {
                $_SESSION['success'] = "ลงทะเบียนสำเร็จ โปรดเข้าสู่ระบบ";
            } else {
                $_SESSION['errors'] = "ลงทะเบียนไม่สำเร็จ";
            }
        }
        header('location: register.php');
    }
    mysqli_close($conn);
