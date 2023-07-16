<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>สมัครสมาชิกหน่วยงานภายนอก</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>


<body>

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">สมัครสมาชิกสำหรับหน่วยงานภายนอก</h1>
							<?php if (isset($_SESSION['errors'])) : ?>
							<div class="notification text-center">
								<h3>
									<?php
									echo $_SESSION['errors'];
									unset($_SESSION['errors']);
									?>
								</h3>
							</div>
						<?php endif ?>
						</div>
						
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="outside_sign-updb.php" method="post">
										<div class="mb-3">
											<label class="form-label">ชื่อผู้ใช้</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your name" />
										</div>

										<div class="mb-3">
											<label class="form-label">รหัสผ่าน</label>
											<input class="form-control form-control-lg" type="text" name="password" placeholder="Enter your name" />
										</div>

										<div class="mb-3">
											<label class="form-label">ยืนยันรหัสผ่าน</label>
											<input class="form-control form-control-lg" type="text" name="c_password" placeholder="Enter your name" />
										</div>

										<div class="mb-3">
											<label class="form-label">ชื่อหน่วยงาน</label>
											<input class="form-control form-control-lg" type="text" name="outsidename" placeholder="Enter your name" />
										</div>

										<div class="mb-3">
											<label for="exampleFormControlTextarea1" class="form-label">รายละเอียดหน่วยงาน</label>
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" type="text" name="outsidedetails" placeholder="Enter your name"></textarea>
										</div>

										<div class="mb-3">
											<label class="form-label">ที่อยู่หน่วยงาน</label>
											<input class="form-control form-control-lg" type="text" name="outsideaddress" placeholder="Enter your company name" />
										</div>

										<div class="mb-3">
											<label class="form-label">ชื่อผู้ติดต่อ</label>
											<input class="form-control form-control-lg" type="text" name="coname" placeholder="Enter your company name" />
										</div>

										<div class="mb-3">
											<label class="form-label">เบอร์โทรศัพท์ผู้ติดต่อ</label>
											<input class="form-control form-control-lg" type="text" name="cophone" placeholder="Enter your company name" />
										</div>

										<div class="text-center mt-3">
											<button type="submit" name="singupoutside" class="btn btn-lg btn-primary">Sign up</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>



	<script src="js/app.js"></script>

</body>

</html>