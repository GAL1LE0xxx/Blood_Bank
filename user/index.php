<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body>
    <header>
        <h1>หน้าหลัก</h1>
    </header>
    <section>
        <nav>
            <ul>
                <li><a href="#">หน้าหลัก</a></li>
                <li><a href="user.php">จัดการข้อมูลผู้ใช้</a></li>
                <li><a href="officer_data.php">จัดการข้อมูลเจ้าหน้าที่</a></li>
                <li><a href="#">เมนู 2</a></li>
                <li><a href="index.php?logout='1'">ออกจากระบบ</a></li>
            </ul>
        </nav>

        <article>
            <div class="header">
                <h2>WELCOME!</h2>
            </div>
            <div class="content">
                <?php if (isset($_SESSION['username'])) : ?>
                    <p>ยินดีต้อนรับคุณ <?php echo $_SESSION['username']; ?></p>
                    <p></p>
                <?php endif ?>
            </div>
        </article>
    </section>

    <footer>
        <p>Footer</p>
    </footer>

</body>

</html>