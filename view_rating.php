<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
		$get_product = $object->get_one_row_from_one_table('orders', 'unique_id', $order_id);
		$product_id = $get_product['product_id'];
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
				<h1 style="color: #1C174C;">View Rating</h1>
				<p>Hello, view your rating for the product here</p>
				<div class="card me-3">
					<div class="container mt-3">
						<?php
							$get_rating = $object->get_one_row_from_one_table('ratings', 'order_id', $order_id);
							$rating = $get_rating['rating'];
						?>
						<div class="mb-3">
							<small><?= $rating.' star(s)';?></small> <br>
							<div class="rating">
                              <input type="radio" name="rating" value="5" id="5" <?= $rating == 5 ? 'checked' : ''?> disabled><label for="5" title="5 star">☆</label> <input type="radio" name="rating" value="4" id="4" <?= $rating == 4 ? 'checked' : ''?> disabled><label for="4" title="4 star">☆</label> 
                              <input type="radio" name="rating" value="3" id="3" <?= $rating == 3 ? 'checked' : ''?> disabled><label for="3" title="3 star">☆</label> 
                              <input type="radio" name="rating" value="2" id="2" <?= $rating == 2 ? 'checked' : ''?> disabled><label for="2" title="2 star">☆</label> 
                              <input type="radio" name="rating" value="1" id="1" <?= $rating == 1 ? 'checked' : ''?> disabled><label for="1" title="1 star">☆</label>
                          	</div>
							<?php echo $get_rating['review']?>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
