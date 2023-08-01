<?php
include("../connect.php");
session_start();

if (isset($_POST['add_bloodtype'])) {
    $wbblood = $_POST['wbblood'];
   
    $sql = "SELECT * FROM wholeblood WHERE wb_bloodtype = '$wbblood'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
   
    
        $sql = "INSERT INTO wholeblood (wb_bloodtype) VALUES ('$wbblood')";
        if (mysqli_query($conn, $sql)) {

            $_SESSION['success'] = "เพิ่มข้อมูลสำเร็จ";
        } else {
            $_SESSION['errors'] = "เพิ่มข้อมูลไม่สำเร็จ";
        }
   
    mysqli_close($conn);
    header('location: blood.php');
}
mysqli_close($conn);
