<?php
session_start();
session_destroy();
echo "<script>alert('ออกจากระบบสำเร็จ'); window.location.href='home.php';</script>";
exit();
?>
