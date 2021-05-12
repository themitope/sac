<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_count_user_order = $object->get_number_of_rows_one_param('orders','user_id',$user_id);
		$get_user_order = $object->get_rows_from_one_table_by_id('orders', 'user_id',$user_id);
		$get_user_info = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
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
				<h1 style="color: #1C174C;">Addresses</h1>
				<p>The following addresses will be used on the checkout page by default</p>
				<div class="card me-4" style="border-radius: 10px;">
					<div class="container mt-3">
						<nav>
						  <div class="nav nav-tabs" id="nav-tab" role="tablist">
						    <button class="nav-link ms-2 active fw-bold" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="font-size: 15px;">Billing Address</button>
						    <button class="nav-link fw-bold" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Shipping Address</button>
						  </div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
						  <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						  	<div class="container mt-4">
						  		<form id="save_address_form" method="post">
						  			<div class="row">
							  			<div class="col-md-6">
							  				<small>*required fields</small>
											<div class="mt-3">
												<label class="my_label">Full Name*</label>
												<input type="text" name="fullname" class="form-control my_input" value="<?= $get_user_info['fullname'];?>">
											</div>
											<div class="mt-3">
												<label class="my_label">Country*</label>
												<input type="text" name="country" class="form-control my_input" value="<?= $get_user_info['country'];?>">
											</div>
											<div class="mt-3">
												<label class="my_label">Street Address*</label>
												<input type="text" name="address" class="form-control my_input" value="<?= $get_user_info['address'];?>">
											</div>
											<small class="fw-bold"> + Add another address field (optional)</small>
											<div class="mt-3">
												<label class="my_label">Postcode / ZIP*</label>
												<input type="number" name="postcode" class="form-control my_input" value="<?= $get_user_info['postcode'];?>">
											</div>
											<h6 style="color: #1C174C;" class="mt-4">CONTACT INFORMATION</h6>
											<div class="mt-3">
												<label class="my_label">Email*</label>
												<input type="text" name="email" class="form-control my_input" value="<?= $get_user_info['email'];?>">
											</div>
											<div class="mt-3">
												<label class="my_label">Phone*</label> <small>For delivery-related queries</small>
												<input type="number" name="phone" class="form-control my_input" value="<?= $get_user_info['phone'];?>">
											</div>
											<button class="mt-3 mb-4 btn" type="button" id="save_address" style="background-color: #1C174C; color: #fff; border-radius: 10px;">Save Address</button>
									  	</div>
							  		</div>
						  		</form>
						  	</div>
						  </div>
						  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						  	<div class="container">
						  		<form class="mt-4 mb-5">
									<input type="checkbox" name="" checked=""> &nbsp;&nbsp;<small>Same as billing address</small>
								</form>
						  	</div>
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
