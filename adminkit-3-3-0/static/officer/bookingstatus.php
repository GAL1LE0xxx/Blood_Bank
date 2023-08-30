<?php
// Include the database connection file
include('../connect.php');

$oc_id = $_GET['oc_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Perform the approval process based on the ID
    
    // Update the status in the database using parameterized query
    $sql = "UPDATE outsiteservice SET out_approval = 1, oc_id = ? WHERE out_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $oc_id, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
} elseif (isset($_GET['did'])) {
    $id = $_GET['did'];
    
    // Perform the disapproval process based on the ID
    
    // Update the status in the database using parameterized query
    $sql = "UPDATE outsiteservice SET out_approval = 2, oc_id = ? WHERE out_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $oc_id, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
header('location: booking_ap.php');
?>
