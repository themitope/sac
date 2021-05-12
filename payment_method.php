<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_count_user_order = $object->get_number_of_rows_one_param('orders','user_id',$user_id);
		$get_user_order = $object->get_rows_from_one_table_by_id('orders', 'user_id',$user_id);
		$get_user_payment_method = $object->get_one_row_from_one_table('payment_method', 'user_id', $user_id);
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
				<h1 style="color: #1C174C;">Payment Methods</h1>
				<p>Hello, see your payment methods here</p>
				<form id="payment_method_form">
					<div class="payment_card mt-3">
						<div class="row">
							<div class="col-md-4">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="payment_method" id="flutter" value="flutter" <?= $get_user_payment_method['payment_method'] == 'flutter' ? 'checked' : '';?>>
								  <label class="form-check-label" for="">
								    <div class="d-flex">
								    	Debit Card payment via <img src="assets/images/flutter-removebg-preview.png" class="img-fluid w-25">
								    </div>
								  </label>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="d-flex col-md-2 ms-4">
								<img src="assets/images/master_card.jpg" class="img-fluid w-25 me-3">
								<img src="assets/images/verve2.png" class="img-fluid w-25 me-3">
								<img src="assets/images/visa-removebg-preview.png" class="img-fluid w-25">
							</div>
						</div>
					</div>
					<div class="payment_card mt-3">
						<div class="row">
							<div class="col-md-4">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="payment_method" id="paystack" value="stripe" <?= $get_user_payment_method['payment_method'] == 'stripe' ? 'checked' : '';?>>
								  <label class="form-check-label" for="">
								    <div class="d-flex">
								    	Debit Card payment via <img src="assets/images/paystack-removebg-preview.png" class="ms-2 mt-2 img-fluid w-25 h-50">
								    </div>
								  </label>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="d-flex col-md-2 ms-4">
								<img src="assets/images/master_card.jpg" class="img-fluid w-25 me-3">
								<img src="assets/images/visa-removebg-preview.png" class="img-fluid w-25">
							</div>
						</div>
					</div>
					<button id="payment_method_btn" class="btn ms-4 mt-5" type="button" style="background-color: #1C174C; color: #fff; border-radius: 10px;">
						Add Payment Method
					</button>
				</form>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
