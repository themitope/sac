<?php 
	session_start();
	include('includes/header.php');
	$prev_page = isset($_GET['prev_page']) ? $_GET['prev_page']: '';
	if(isset($_SESSION['user'])){
		if($prev_page == ''){
			header("Location: index");
		}
		else{
			header("Location: ".$prev_page);
		}
	}
?>
<div class="row me-5 ms-5 justify-content-center">
	<div class="col-md-5 fill_image">
		<div class="row">
			<div class="col-md-2 ms-4 my-4">
				<img src="assets/images/sac.png" alt="sac_logo" class="img-fluid">
			</div>
			<div class="col-md-12">
				<img src="assets/images/good-looking- 1.png" class="good_looking_image img-fluid" style="">
			</div>
		</div>
	</div>
	<div class="col-md-5 fill_form">
		<div class="container mt-5">
			<form class="" id="login_form" method="post">
				<div class="form-group">
					<label class="fw-bold mt-5">Username or Email</label>
					<input type="text" name="username_or_email" class="mt-3 form-control form-control-lg">
				</div>
				<div class="form-group">
					<label class="fw-bold mt-3">Password</label>
					<input type="password" name="password" class="mt-3 form-control form-control-lg">
				</div>
				<div class="mb-3 form-check mt-3">
                	<input type="checkbox" class="form-check-input" id="exampleCheck1">
                	<label class="form-check-label ms-2 fw-bold" for="exampleCheck1" style="color: #1C174C">Remember Me</label>
              	</div>
              	<input type="hidden" name="prev_page" id="prev_page" value="<?= $prev_page;?>">
              	<div class="d-grid gap-2">
              		<button class="mt-3 btn btn-block btn-lg" id="login_btn" style="background-color: #1C174C; color: #fff">Login</button>
              	</div>
              	<a href="forgot_password" class="float-end fw-bold mt-2" style="color: #1C174C; text-decoration: none">Forgot Password?</a>
              	<div class="fw-bold mt-5">Don't have an account? <a href="register" style="color: #1C174C; text-decoration: none">Register</a></div>
			</form>
		</div>
	</div>
</div>
<?php include("includes/scripts.php");?>