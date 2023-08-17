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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
</head>


<body>

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">ลงทะเบียนสำหรับผู้บริจาค</h1>

						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="donorsign-updb.php" method="post">
										<div class="row gx-3 mb-3">
											<div class="col-md-6">
												<label class="text mb-1" for="username">ชื่อผู้ใช้</label>
												<input class="form-control" name="username" type="text" placeholder="กรุณากรอกชื่อผู้ใช้">
											</div>
											<div class="col-md-6">
												<label class="text mb-1" for="name">ชื่อ-สกุล</label>
												<input class="form-control" name="name" type="text" placeholder="กรุณากรอกชื่อและนามสกุล">
											</div>
										</div>

										<div class="row gx-3 mb-3">
											<div class="col-md-6">
												<label class="text mb-1" for="password">รหัสผ่าน</label>
												<input class="form-control" name="password" type="password" placeholder="กรุณากรอกรหัสผ่าน">
											</div>
											<div class="col-md-6">
												<label class="text mb-1" for="c_password">ยืนยันรหัสผ่าน</label>
												<input class="form-control" name="c_password" type="password" placeholder="กรุณายืนยันรหัสผ่าน">
											</div>
										</div>

										<div class="row gx-3 mb-3">
											<div class="col-md-6">
												<label class="text mb-1" for="persernalid">เลขประจำตัวประชาชน</label>
												<input class="form-control" name="persernalid" type="text" placeholder="กรุณากรอกเลขประจำตัวประชาชน">
											</div>
											<div class="col-md-6">
												<label class="text mb-1" for="email">อีเมล</label>
												<input class="form-control" name="email" type="email" placeholder="กรุณากรอกอีเมล">
											</div>
										</div>


										<div class="mb-3">
											<label class="form-label">ที่อยู่</label>
											<input class="form-control form-control-lg" type="text" name="address" placeholder="กรุณากรอกที่อยู่" />
										</div>

										<div class="row gx-3 mb-3">
											<div class="col-md-6">
												<label class="form-label">เบอร์โทรศัพท์</label>
												<input class="form-control form-control-lg" type="text" name="phonenumber" placeholder="กรุณากรอกเบอร์โทรศัพท์" />
											</div>
											<div class="col-md-6">
												<label class="form-label" for="gender">เพศ</label>
												<select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="gender">
													<option selected>กรุณาเลือกเพศของท่าน</option>
													<option value="0">ชาย</option>
													<option value="1">หญิง</option>
												</select>
											</div>
										</div>

										<div class="mb-3">
											<label class="form-label">วัน/เดือน/ปี เกิด</label>
											<input class="form-control form-control-lg" type="date" name="birthdate" placeholder="" />
										</div>

										<div class="text-center mt-3">
											<button type="submit" name="singupuser" class="btn btn-lg btn-success">สมัครสมาชิก</button>
                                            <td><a class='btn btn-lg btn-danger' href='donorsign-in.php'>ย้อนกลับ</a></td>
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


	<script>
		// Get the URL query parameters
		const urlParams = new URLSearchParams(window.location.search);
		const status = urlParams.get('status');
		const msg = urlParams.get('msg');

		// Check the status and display the SweetAlert message
		if (status === 'success') {
			Swal.fire({
				title: 'ลงทะเบียนสำเร็จ',
				text: msg,
				icon: 'success',
				confirmButtonClass: 'btn btn-primary'
			}).then((result) => {
				if (result.isConfirmed) {
					// Redirect to order.php with success status and message
					const redirectURL = 'donorsign-in.php';
					window.location.href = redirectURL;
				}
			});
		} else if (status === 'error') {
			Swal.fire({
				title: 'ลงทะเบียนไม่สำเร็จ',
				text: msg,
				icon: 'error',
				confirmButtonClass: 'btn btn-primary'
			}).then((result) => {
				if (result.isConfirmed) {
					// Redirect to order.php with success status and message
					const redirectURL = 'donorsign-up.php';
					window.location.href = redirectURL;
				}
			});
		}
	</script>
	<script src="js/app.js"></script>

</body>

</html>