<?php
    include("../connect.php");
    session_start();
    
    if (isset($_POST['edit_officer'])){
        $id = $_POST['oc_id'];
        $username = $_POST['oc_username'];
        $firstname = $_POST['oc_firstname'];
        $lastname = $_POST['oc_lastname'];
        $phonenumber = $_POST['oc_phonenumber'];
        $position= $_POST['oc_position'];
        $sql = "UPDATE officer SET oc_username='$username',oc_firstname='$firstname',oc_lastname='$lastname',oc_phonenumber='$phonenumber',oc_position='$position' WHERE oc_id='$id'";
        if(mysqli_query($conn,$sql)) {
            $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        } else {
            $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        }
    }
    header('location: officer.php');
    mysqli_close($conn);
