<?php
include ("../dbconfig.php");
session_start();

$sql = "SELECT * FROM outsiteservice";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // ดึงข้อมูลและเพิ่มไปยังอาร์เรย์ของเหตุการณ์
        $events[] = array(
            'title' => $row['out_location'],
            'start' => $row['out_start'],
            'end' => $row['out_end'],   
            'extendedProps' => array(
                'description' => $row['out_amount']
            )
        );
    }
}


// Return events as JSON
header('Content-Type: application/json');
echo json_encode($events);
?>
