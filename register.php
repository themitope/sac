<?php include('includes/header.php');?>
<div class="row me-5 ms-5 justify-content-center">
	<div class="col-md-5 fill_form">
		<div class="container mb-5">
			<div class="col-md-2 my-4">
				<img src="assets/images/sac_logo3.png" alt="sac_logo" class="img-fluid">
			</div>
			<form class="" id="register_form" method="POST">
				<div class="form-group">
					<label class="fw-bold mt-3">Email</label>
					<input type="email" name="email" class="mt-3 form-control form-control-lg">
				</div>
				<div class="mt-3">
					<p style="color: #1C174C;" class="fw-bold">A password will be sent to your email address.<br><br> Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy. Register</p>
				</div>
              	<div class="d-grid gap-2">
              		<button class="mt-3 btn btn-block btn-lg" id="register_btn" style="background-color: #1C174C; color: #fff" type="button">Register</button>
              	</div>
              	<div class="fw-bold mt-4 mb-5">Already have an account? <a href="login" style="color: #1C174C; text-decoration: none">Login</a></div>
			</form>
		</div>
	</div>
	<div class="col-md-5 fill_image">
		<div class="row">
			<div class="col-md-12">
				<img src="assets/images/inspired-african-.png" class="good_looking_image2 img-fluid" style="">
			</div>
		</div>
	</div>
</div>
<?php include("includes/scripts.php");?>