<?php
    include("connect.php");
    session_start();
    
    if (isset($_POST['edit_news'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phonenumber = $_POST['phonenumber'];
        $position= $_POST['position'];
        $sql = "UPDATE officer SET ousername='$username',firstname='$firstname',lastname='$lastname',phonenumber='$phonenumber',position='$position' WHERE id='$id'";
        if(mysqli_query($conn,$sql)) {
            $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        } else {
            $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        }
    }
    header('location: adminkit-3-3-0/static/index.php');
    mysqli_close($conn);
?>