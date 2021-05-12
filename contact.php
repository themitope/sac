<?php include('includes/header.php');?>
<body>
<?php include('includes/navbar1.php')?>
<div style="background-color: #1C174C;">
	<div class="contact_container" style="">
		<div class="centered">
			<h1 class="text-white mt-" style="font-size: 60px;">Contact Us</h1>
		</div>
	</div>
</div>

<section class="mt-5 mb-5">
	<div class="container text-white">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<form id="contact_us_form">
					<div class="form-group">
						<label style="color: #99999F">Name</label>
						<input type="text" name="name" class="form-control mt-2 my_contact_input">
					</div>
					<div class="form-group mt-2">
						<label style="color: #99999F">Email</label>
						<input type="email" name="email" class="form-control mt-2 my_contact_input">
					</div>
					<div class="form-group mt-2">
						<label style="color: #99999F">Phone</label>
						<input type="number" name="phone" class="form-control mt-2 my_contact_input">
					</div>
					<div class="form-group mt-2">
						<label style="color: #99999F">Message</label>
						<textarea name="name" class="form-control mt-2 my_contact_input" rows="10"></textarea>
					</div>
					<div class="d-grid gap-2 mt-3">
	              		<button class="mt-3 btn btn-block" style="background-color: #1C174C; color: #fff">Send &nbsp;&nbsp;&nbsp;&nbsp;
	              			<i class="fas fa-paper-plane"></i>
	              		</button>
	              	</div>
				</form>
			</div>
			<div class="col-md-5">
				<img src="assets/images/location.jpg" class="img-fluid mt-4" style="mix-blend-mode: luminosity;">
				<div class="d-flex mt-4">
					<span style="color: #99999F; font-size: 17px" class="me-5"><i class="fas fa-map-marker-alt" style="color: #1C174C; font-size: 18px"></i> Lorem Ipsum</span>
					<span style="color: #99999F; font-size: 17px" class="ms-5"><i class="fas fa-envelope" style="color: #1C174C; font-size: 18px"></i> Lorem Ipsum</span>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
</body>
</html>