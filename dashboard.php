<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_count_user_order = $object->get_number_of_rows_one_param('orders','user_id',$user_id);
		$cart_items_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
		//$get_count_user_download = $object->get_number_of_rows_one_param('orders','user_id',$user_id);
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
				<h1 style="color: #1C174C;">Dashboard</h1>
				<p>Welcome back, <?= $get_user['fullname'];?></p>
				<p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, <br> and edit your password and account details.</p>
				<div class="row">
					<div class="col-md-4 mb-4">
						<a href="my_orders" style="text-decoration: none;">
							<div class="card dashboard_card" style="border-radius: 10px;">
								<i class="fas fa-clipboard-list fa-2x text-info"></i>
								<div class="text-center">
									<h2>
										<?= $get_count_user_order;?>
									</h2>
									<h5>Orders <br>this week</h5>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="my_downloads" style="text-decoration: none;">
							<div class="card dashboard_card" style="border-radius: 10px;">
								<i class="fas fa-download fa-2x text-success"></i>
								<div class="text-center">
									<h2>
										<?= $cart_items_count;?>
									</h2>
									<h5>Downloads <br>this week</h5>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="addresses" style="text-decoration: none;">
							<div class="card dashboard_card" style="border-radius: 10px;">
								<i class="fas fa-map-marked-alt fa-2x text-success"></i>
								<div class="text-center mb-5 mt-3">
									<h5>Addresses</h5>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="payment_method" style="text-decoration: none;">
							<div class="card dashboard_card" style="border-radius: 10px;">
								<i class="fas fa-credit-card fa-2x text-primary"></i>
								<div class="text-center mb-5 mt-3">
									<h5>Payment methods</h5>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 mb-4">
						<a href="account_details" style="text-decoration: none;">
							<div class="card dashboard_card" style="border-radius: 10px;">
								<i class="fas fa-user-circle fa-2x text-info"></i>
								<div class="text-center mb-5 mt-3">
									<h5>Account details</h5>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
