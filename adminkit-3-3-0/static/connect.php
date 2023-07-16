<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "blood_bank";

  // ติดต่อฐานข้อมูล
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // ตรวจสอบผลการติดต่อฐานข้อมูล
  // echo "ติดต่อสำเร็จ";
  if (!$conn) {
    die("ไม่สามารถติดต่อกับฐานข้อมูล: " . mysqli_connect_error());
  }

?>