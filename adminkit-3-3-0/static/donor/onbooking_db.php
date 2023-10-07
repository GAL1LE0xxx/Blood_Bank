<?php 
include("../connect.php");
session_start();

if(isset($_POST['onbooking'])){
    $id = $_POST['id'];
    $bookingdate = $_POST['bookingdate'];
    $bookingtime = $_POST['bookingtime'];  

    $sql = "INSERT INTO onsiteservice (dn_id, on_date, on_time) VALUES ('$id', '$bookingdate', '$bookingtime')";
        
    if (mysqli_query($conn, $sql)) {
        $successMessage = "จองคิวสำเร็จ";
        header("Location: onsiteservice.php?status=success&msg=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "จองคิวไม่สำเร็จ";
        header("Location: onsiteservice.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}
mysqli_close($conn);
?>
