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
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
    <link rel="stylesheet" href="adminkit-3-3-0/dist/css/app.css">
</head>

<body>
    <header>
        <h1>ผู้ใช้</h1>
    </header>
    <section>
        <nav>
            <ul>
                <li><a href="index.php">หน้าหลัก</a></li>
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
            <div class="contentdata">
                <a href="user_add.php">Create User</a><br>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    // Include the database connection file
                    include('connect.php');

                    // Fetch data from the database
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["donor_username"] . "</td>";
                            echo "<td>" . $row["firstname"] . "</td>";
                            echo "<td>" . $row["lastname"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";

                            if ($row["gender"] == "0") {
                                echo "<td>Male</td>";
                            } elseif ($row["gender"] == "1") {
                                echo "<td>Female</td>";
                            } else {
                                echo "<td>Unknown</td>";
                            }
                            echo "<td>" . $row["birthdate"] . "</td>";
                            echo "<td><a href='user_edit.php?id=" . $row["id"] . "'>Edit</a></td>";
                            echo "<td><a href='user_delete_db.php?did=" . $row["id"] . "' onclick=\"return confirm('ต้องการลบผู้ใช้แน่หรือไม่? ข้อมูลนี้ไม่สามารถกู้คืนได้.');\">Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </article>
    </section>

    <footer class="footer">
        <p>Footer</p>
    </footer>

</body>

</html>