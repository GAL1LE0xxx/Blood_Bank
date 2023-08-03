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

	<title>สมัครสมาชิก</title>

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
							<h1 class="h2">สมัครสมาชิกผู้บริจาค</h1>
					
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="sign-updb.php" method="post">
										<div class="mb-3">
											<label class="form-label">ชื่อผู้ใช้</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" >
										</div>

										<div class="mb-3">
											<label class="form-label">รหัสผ่าน</label>
											<input class="form-control form-control-lg" type="text" name="password" placeholder="กรุณากรอกรหัสผ่าน" />
										</div>

										<div class="mb-3">
											<label class="form-label">ยืนยันรหัสผ่าน</label>
											<input class="form-control form-control-lg" type="text" name="c_password" placeholder="กรุณายืนยันรหัสผ่าน" />
										</div>

										<div class="mb-3">
											<label class="form-label">ชื่อ-สกุล</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="กรุณากรอกชื่อและนามสกุล" />
										</div>

										<div class="mb-3">
											<label class="form-label">เลขประจำตัวประชาชน</label>
											<input class="form-control form-control-lg" type="text" name="persernalid" placeholder="กรุณากรอกเลขประจำตัวประชาชน" />
										</div>

										<div class="mb-3">
											<label class="form-label">อีเมล</label>
											<input class="form-control form-control-lg" type="text" name="email" placeholder="กรุณากรอกอีเมล" />
										</div>

										<div class="mb-3">
											<label class="form-label">ที่อยู่</label>
											<input class="form-control form-control-lg" type="text" name="address" placeholder="กรุณากรอกที่อยู่" />
										</div>

										<div class="mb-3">
											<label class="form-label">เบอร์โทรศัพท์</label>
											<input class="form-control form-control-lg" type="text" name="phonenumber" placeholder="กรุณากรอกเบอร์โทรศัพท์" />
										</div>

										<div class="mb-3">
											<h5 class="card-title mb-3">เพศ</h5>
											<label class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="mele" name="gender" value="0" required>
												<span class="form-check-label">
													ชาย
												</span>
											</label>

											<label class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="femele" name="gender" value="1"> <span class="form-check-label">
													หญิง
												</span>
											</label>
											
										</div>

										<div class="mb-3">
											<label class="form-label">วัน/เดือน/ปี เกิด</label>
											<input class="form-control form-control-lg" type="date" name="birthdate" placeholder="" />
										</div>

										<div class="text-center mt-3">
											<button type="submit" name="singupuser" class="btn btn-lg btn-primary">สมัครสมาชิก</button>
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