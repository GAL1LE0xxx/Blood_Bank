<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="/img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">ธนาคารเลือด<br>โรงพยาบาลตรัง</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="home.php">
                            <i class="align-middle" data-feather="home"></i> <span class="align-middle">หน้าหลัก</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        จัดการข้อมูล
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="officer.php">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">จัดการข้อมูลเจ้าหน้าที่</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="user.php">
                            <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">จัดการข้อมูลการสมัครสมาชิก</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="blood.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">จัดการข้อมูลโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pr.php">
                            <i class="align-middle" data-feather="globe"></i> <span class="align-middle">จัดการข้อมูลประชาสัมพันธ์</span>
                        </a>


                    <li class="sidebar-header">
                        รายงาน
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-buttons.html">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">ข้อมูลผู้บริจาคโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">การจองคิว</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">ข้อมูลปริมาณโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">ข้อมูลสถานะโลหิต</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                                    tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <!-- จัดการข้อมูลเจ้าหน้าที่ -->
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>จัดการข้อมูลเจ้าหน้าที่</strong> </h1>

                    <div class="row">
                        <div class="col-12 col-lg-15 col-xxl- d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <a href="officer_add.php" class='btn btn-primary'>Create User</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover my-0 ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Persernalid</th>
                                                <th>Birthdate</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Phonenumber</th>
                                                <th>occupation</th>
                                                <th align=center>action</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            // Include the database connection file
                                            include('connect.php');

                                            // Fetch data from the database
                                            $sql = "SELECT * FROM donor";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // Output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["dn_id"] . "</td>";
                                                    echo "<td>" . $row["dn_username"] . "</td>";
                                                    echo "<td>" . $row["dn_name"] . "</td>";
                                                    echo "<td>" . $row["dn_persernalid"] . "</td>";
                                                    echo "<td>" . $row["dn_birthdate"] . "</td>";
                                                   
                                                    if ($row["dn_gender"] == "0") {
                                                        echo "<td>Male</td>";
                                                    } elseif ($row["dn_gender"] == "1") {
                                                        echo "<td>Female</td>";
                                                    } else {
                                                        echo "<td>Unknown</td>";
                                                    }
                                                    echo "<td>" . $row["dn_address"] . "</td>";
                                                    echo "<td>" . $row["dn_phonenumber"] . "</td>";
                                                    echo "<td>" . $row["dn_occupation"] . "</td>";
                                                    echo "<td><a class='btn btn-primary' href='user_edit.php?id=" . $row["dn_id"] .  "'>อนุมัติ</a></td>";
                                                    echo "<td><a class='btn btn-danger' href='user_delete_db.php?did=" . $row["dn_id"] ."'>ไม่อนุมัติ</a></td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }

                                            // Close the database connection
                                            mysqli_close($conn);
                                            ?>
                                        </tbody>
                                </div>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- จบจัดการข้อมูลเจ้าหน้าที่ -->
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ธนาคารเลือด</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>โรงพยาบาลตรัง</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>


</body>

</html>