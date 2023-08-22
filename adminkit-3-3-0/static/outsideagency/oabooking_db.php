<?php 
include("../connect.php");
session_start();

if(isset($_POST['oabooking'])){
    $id = $_POST['id'];
    $location = $_POST['location'];
    $numberdonor = $_POST['numberdonor'];
    $bookingdate = $_POST['bookingdate'];
    $bookingtime = $_POST['bookingtime'];  

    if ($numberdonor >= 50) {
        // Insert into outsiteservice table
        $sql1 = "INSERT INTO outsiteservice (oa_id, out_location, out_amount, out_start, out_end, out_time) VALUES ('$id','$location', '$numberdonor', '$bookingdate','$bookingdate', '$bookingtime')";
        
        // Insert into event table
        $sql2 = "INSERT INTO event (start, end) VALUES ('$bookingdate', '$bookingdate')";

        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
            $successMessage = "จองคิวสำเร็จกรุณารอเจ้าหน้าที่อนุมัติ";
            header("Location: outsideagency.php?status=success&msg=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "จองคิวไม่สำเร็จ";
            header("Location: outsideagency.php?status=error&msg=" . urlencode($errorMessage));
            exit();
        }
    } else {
        $errorMessage = "จำนวนผู้บริจาคต้องไม่น้อยกว่า 50";
        header("Location: outsideagency.php?status=error&msg=" . urlencode($errorMessage));
        exit();
    }
}
?>
