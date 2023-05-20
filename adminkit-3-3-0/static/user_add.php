<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header("location: login.php");
// }
// if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['username']);
//     header("location: login.php");
// }
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="mystyle.css">
</head>

<body>
    <header>
        <h1>logo</h1>
    </header>
    <section>
        <nav>
            <ul>
                <li><a href="user.php">ผู้ใช้</a></li>
                <li><a href="#">เมนู 1</a></li>
                <li><a href="#">เมนู 2</a></li>
                <li><a href="index.php?logout='1'">ออกจากระบบ</a></li>
            </ul>
        </nav>

        <article>
            <div class="headerdata">
                <h2>User</h2>
            </div>
            <div class="contentdata">
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="notification">
                        <h3>
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </h3>
                    </div>
                <?php endif ?>
                <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="notification">
                        <h3>
                            <?php
                            echo $_SESSION['errors'];
                            unset($_SESSION['errors']);
                            ?>
                        </h3>
                    </div>
                <?php endif ?>
                <form action="user_add_db.php" method="post">
                    <label>Username:</label><br>
                    <input type="text" name="username" required><br>
                    <label>รหัสผ่าน:</label><br>
                    <input type="password" name="password" required><br>
                    <label>รหัสผ่าน2:</label><br>
                    <input type="password" name="password2" required><br>
                    <label>ชื่อ:</label><br>
                    <input type="text" name="firstname" required><br>
                    <label>นามสกุล:</label><br>
                    <input type="text" name="lastname" required><br>
                    <label>เบอร์โทรศัพท์:</label><br>
                    <input type="text" name="phonenumber" required><br>
                    <label>เพศ:</label><br>
                    <input type="radio" id="admin" name="position" value="0" required> แอดมิน<br>
                    <input type="radio" id="technicalmed" name="position" value="1"> นักเทคนิคการแพทย์<br>

                    <button type="submit" name="add_user">เพิ่มผู้ใช้</button>
                </form>
            </div>
        </article>
    </section>

    <footer>
        <p>Footer</p>
    </footer>

</body>

</html>