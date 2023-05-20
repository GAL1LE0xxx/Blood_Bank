<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("location: login.php");
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
    include "connect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM officer WHERE oc_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $username = $row['oc_username'];
        $firstname = $row['oc_firstname'];
        $lastname = $row['oc_lastname'];
        $phonenumber = $row['oc_phonenumber'];
        $position = $row['oc_position'];
    }
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
            <form action="user_edit_db.php" method="post">
                <label>ID:</label><br>
                <input type="text" name="id" value="<?php echo $id; ?>" readonly><br>
                <label>Username:</label><br>
                <input type="text" name="username" value="<?php echo $username; ?>" required><br>
                <label>ชื่อ:</label><br>
                <input type="text" name="firstname" value="<?php echo $firstname; ?>" required><br>
                <label>นามสกุล:</label><br>
                <input type="number" name="lastname" value="<?php echo $lastname; ?>" required><br>
                <label>เบอร์โทรศัพท์:</label><br>
                <input type="number" name="phonenumber" value="<?php echo $phonenumber; ?>" required><br>
                <label>ตำแหน่ง:</label><br>
                <input type="radio" id="Admin" name="position" value="0" <?php if($position=="0") {echo "checked";} ?> required> แอดมิน<br>
                <input type="radio" id="Technicalmed" name="position" value="1" <?php if($position=="1") {echo "checked";} ?>required> นักเทคนิคการแพทย์<br>
                
                <button type="submit" name="edit_user">แก้ไข</button>
            </form>
            </div>
        </article>
</section>

<footer>
  <p>Footer</p>
</footer>
<?php
    mysqli_close($conn);
?>
</body>
</html>