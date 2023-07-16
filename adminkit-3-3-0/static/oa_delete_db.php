<?php
    include("connect.php");
    session_start();
    
    if (isset($_GET['did'])){
        $id = $_GET['did'];
        $sql = "DELETE FROM outsideagency WHERE oa_id='$id'";
        if(mysqli_query($conn,$sql)) {
            $_SESSION['success'] = "ลบผู้ใช้สำเร็จ";
        } else {
            $_SESSION['errors'] = "ลบผู้ใช้ไม่สำเร็จ";
        }
    }
    header('location: member.php');
    mysqli_close($conn);
?>