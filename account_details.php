<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_name = explode(' ', $get_user['fullname']);
		@$first_name = $get_name[1];
		@$last_name = $get_name[0];
	?>
	<section class="ms-5 mt-4 mb-5">
		<div class="row">
			<div class="col-md-3">
				<div class="new_sidebar">
					<div class="d-flex sidebar_top">
						<i class="fas fa-user-circle fa-3x text-white"></i><span class="ms-2 mt-2 text-white" style="font-size: 18px;"> <?= $get_user['fullname'];?></span>
					</div>
					<div class="sidebar_bottom">
						<ul>
							<li><i class="fas fa-home me-3" style="color: #818E94;"></i><a href="dashboard">Dashboard</a></li>
							<li><i class="fas fa-clipboard-list me-3" style="color: #1C174C;"></i><a href="my_orders">Orders</a></li>
							<li><i class="fas fa-download me-3" style="color: #818E94;"></i><a href="my_downloads">Downloads</a></li>
							<li><i class="fas fa-map-marker-alt me-3" style="color: #818E94;"></i><a href="address">Addresses</a></li>
							<li><i class="fas fa-credit-card me-3" style="color: #818E94;"></i><a href="payment_method">Payment Methods</a></li>
							<li><i class="fas fa-user-circle me-3" style="color: #818E94;"></i><a href="account_details">Account Details</a></li>
							<li class="mb-4"><i class="fas fa-sign-out-alt me-3" style="color: #818E94;"></i><a href="logout">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<h1 style="color: #1C174C;">Account</h1>
				<p>Hello, see your Account Details</p>
				<div class="row me-2">
					<div class="col-md-12">
						<div class="sidebar_top text-center">
							<i class="fas fa-user-circle fa-5x text-white"></i><span ></span>
							<div class="ms-2 mt-2 text-white" style="font-size: 18px;"><?= $get_user['fullname'];?></div>
						</div>
					</div>
				</div>
				<div class="row me-2 mt-4">
					<div class="col-md-12">
						<div class="card" style="border-radius: 8px;">
							<div class="container mt-4 mb-5">
								<form id="edit_profile_form" method="post">
									<div class="row">
										<div class="col-md-6">
											<label>First Name</label>
											<input type="text" name="first_name" class="mt-3 my_input form-control"style="padding: 15px;" value="<?= $first_name?>">
										</div>
										<div class="col-md-6">
											<label>Last Name</label>
											<input type="text" name="last_name" class="mt-3 my_input form-control"style="padding: 15px;" value="<?= $last_name;?>">
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-6">
											<label>Username</label>
											<input type="text" name="username" class="mt-3 my_input form-control"style="padding: 15px;" value="<?= $get_user['username']?>">
										</div>
										<div class="col-md-6">
											<label>Email</label>
											<input type="email" name="email" class="mt-3 my_input form-control"style="padding: 15px;" value="<?= $get_user['email']?>">
										</div>
									</div>
									<div class="row mt-5">
										<h6>PASSWORD CHANGE</h6>
										<div class="col-md-6">
											<label>Current password</label>
											<input type="password" name="old_password" class="mt-3 my_input form-control"style="padding: 15px;">
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-6">
											<label>New password</label>
											<input type="password" name="new_password" class="mt-3 my_input form-control"style="padding: 15px;">
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-6">
											<label>Confirm new password</label>
											<input type="password" name="confirm_password" class="mt-3 my_input form-control"style="padding: 15px;">
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-6">
											<label>Additional Details</label><br>
											<label>Input your Instagram Handle (optional)</label>
											<input type="text" name="instagram_handle" class="mt-3 my_input form-control"style="padding: 15px;" placeholder="@" value="<?= $get_user['instagram_handle']?>">
										</div>
									</div>
									<button class="mt-4 mb-4 btn" type="button" id="edit_profile_btn" style="background-color: #1C174C; color: #fff; border-radius: 10px;">Save Changes</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
