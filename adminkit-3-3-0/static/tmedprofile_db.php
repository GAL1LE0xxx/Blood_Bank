<?php
    include("connect.php");
    session_start();
    
    if (isset($_POST['edit_tmedprofile'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phonenumber = $_POST['phonenumber'];
        
        $sql = "UPDATE officer SET oc_username='$username',oc_firstname='$firstname',oc_lastname='$lastname',oc_phonenumber='$phonenumber' WHERE OC_id = '$id'";
        if(mysqli_query($conn,$sql)) {
            $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        } else {
            $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        }
    }
    header('location: member.php');
    mysqli_close($conn);
