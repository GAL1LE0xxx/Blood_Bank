<?php
    include("connect.php");
    session_start();
    
    if (isset($_POST['edit_wbblood'])){
        $id = $_POST['wb_id'];
        $wbblood = $_POST['wb_bloodtype'];
        
        $sql = "UPDATE wholeblood SET wb_bloodtype='$wbblood' WHERE sb_id='$id'";
        if(mysqli_query($conn,$sql)) {
            $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
        } else {
            $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
        }
    }
    header('location: blood.php');
    mysqli_close($conn);
