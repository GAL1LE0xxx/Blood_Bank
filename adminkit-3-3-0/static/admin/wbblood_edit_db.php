<?php
include("../connect.php");
session_start();
    
if (isset($_POST['edit_wbbloods'])){
    $wbblood = $_POST['wb_blood'];
    $id = $_POST['wb_id'];
        
    $sql = "UPDATE wholeblood SET wb_bloodtype ='$wbblood' WHERE wb_id='$id'";
    if(mysqli_query($conn,$sql)) {
        $_SESSION['success'] = "แก้ไขผู้ใช้สำเร็จ";
    } else {
        $_SESSION['errors'] = "แก้ไขผู้ใช้ไม่สำเร็จ";
    }
}
mysqli_close($conn);
header('location: blood.php');
?>
