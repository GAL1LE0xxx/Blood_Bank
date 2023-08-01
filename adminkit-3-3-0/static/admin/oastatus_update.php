<?php
// Include the database connection file
include('../connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Perform the approval process based on the ID
    
    // Update the status in the database
    $sql = "UPDATE outsideagency SET oa_status = 1 WHERE oa_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
} elseif (isset($_GET['did'])) {
    $id = $_GET['did'];
    // Perform the disapproval process based on the ID
    
    // Update the status in the database
    $sql = "UPDATE outsideagency SET oa_status = 2 WHERE oa_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
header('location: member_ap.php');
?>
