<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $instansi; ?></title>
	<base href="<?php echo Dee::$app->baseUrl; ?>" />



	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>backend/vendor.css">
	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>backend/plugins.css">
	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>backend/toastr.min.css">
	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>backend/toastr-custom.css">
	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>backend/main.css">
	<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl . '/public/assets/css/'; ?>sweetalert2.min.css" />

	<script src="<?php echo Dee::$app->baseUrl . '/public/assets/js/'; ?>backend/vendor.js"></script>
	<script src="<?php echo Dee::$app->baseUrl . '/public/assets/js/'; ?>backend/plugins.js"></script>
	<script src="<?php echo Dee::$app->baseUrl . '/public/assets/js/'; ?>backend/toastr1.min.js"></script>
	<script src="<?php echo Dee::$app->baseUrl . '/public/assets/js/'; ?>backend/main.js"></script>
	<script src="<?php echo Dee::$app->baseUrl . '/public/assets/js/'; ?>backend-login.js"></script>
</head>

<body>
	<div class="preloader-wrapper">
		<div class="preloader">
			<img src="<?php echo Dee::$app->baseUrl . '/public/assets/images/ring.gif'; ?>" alt="Logo">
		</div>
	</div>

	<main>
		<section class="body-login">
			<div class="container">
				<div class="d-flex justify-content-center align-items-center form-place">
					<h2 style="color: #333;">Login Admin <?= $instansi ?></h2>
					<div class="row justify-content-center w-100">
						<div class="col-sm-10 col-md-7 col-lg-5 form-box" style="background-color: #595959; border-radius: 10px; padding: 20px;">
							<div class="row align-items-center form-content">
								<div class="col-sm-5 logo">
									<img src="<?php echo Dee::$app->baseUrl . '/public/uploads/BI-putih.png'; ?>" class="img-fluid">
								</div>
								<div class="col-sm-7 content">
									<h1 style="color: #333;">Masukan username dan password</h1>
									<form action="<?= Dee::createUrl('admin/login/sign-in') ?>" id="form-login" autocomplete="off" method="POST">
										<div class="form-group">
											<input type="text" class="form-control form-control-sm" name="username" required="required" minlength="5" placeholder="Username" loginRegex style="border-radius: 5px;">
										</div>
										<div class="form-group">
											<div class="input-group">
												<input type="password" class="form-control form-control-sm" name="password" required="required" minlength="5" placeholder="Password" style="border-radius: 5px;" />
												<div class="input-group-append">
													<button class="btn btn-sm btn-outline-secondary btn-show-password" type="button"><i class="far fa-eye"></i></button>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row align-items-center">
												<div style="width: 35%; float: left;">
													<img src="<?php echo $_SESSION['captcha']['image_src']; ?>" class="img-fluid" alt="" style="border-radius: 5px;">
												</div>
												<div style="width: 57%; float: left;">
													<input type="number" class="form-control" name="captcha" placeholder="Code captcha" required="required" style="border-radius: 5px;">
												</div>
											</div>
										</div>
										<div class="form-group">
											<button type="submit" name="submit" class="btn btn-sm btn-login" style="background-color: #5cb85c; border-color: #4cae4c;"><i class="fas fa-sign-in-alt"></i> Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<a href="<?php echo Dee::$app->baseUrl ?>" class="btn-back" style="color: #333;"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
				</div>
			</div>

		</section>
	</main>
	<script>
		$(window).on("load", function(e) {
			$('.preloader-wrapper').hide();
		});
		$(document).ready(function() {
			$('input[name="username"]').rules("add", {
				loginRegex: true,
				remote: {
					url: "<?= Dee::createUrl('admin/login/check') ?>",
					type: "POST"
				},
				messages: {
					remote: "Username tidak ada"
				}
			});
		});
	</script>
	<script src="<?= Dee::$app->baseUrl . '/public/assets/js/' ?>sweetalert2.min.js"></script>
</body>

</html>