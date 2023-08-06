<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <script>
        Swal.fire({
            title: 'ออกจากระบบสำเร็จ',
            icon: 'success'
        }).then(function() {
            window.location.href = 'home.php';
        });
    </script>

</body>

</html>
