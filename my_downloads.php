<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
		//$get_user_downloads = $object->get_rows_from_one_table_by_id('orders', 'user_id',$user_id);
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
				<h1 style="color: #1C174C;">Downloads</h1>
				<p>Hello, see your downloads here</p>
				<div class="card me-3">
					<div class="container mt-3">
						<?php
							if($cart_items == null){
						?>
						<div class="row justify-content-center mb-5">
							<i class="fas fa-download fa-4x" style="color: #C7C7C7;"></i>
							<p style="color: #C7C7C7" class="text-center">No downloads yet</p>
							<a href="index" class="text-center"><button class="btn" style="background-color: #1C174C; color: #fff">Browse Products</button></a>
						</div>
						<?php
							}else{
						?>
						<div class="row">
							<table>
								<thead>
									<tr>
										<th><h6 style="color: #1C174C;" class="fw-bold">PRODUCT</h6></th>
										<th>PRICE</th>
										<th>QUANTITY</th>
										<th>SUBTOTAL</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($cart_items as $value) {
											$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $value['product_id']);
										?>
											<tr class="mb-5">
												<td class="mb-3" style="color: #707070">
													<img src="admin/<?= $get_product['product_image'];?>" style="border-radius: 10px;"><br>
													<small style="color: #707070"><?= $get_product['name'];?></small>
												</td>
												<td style="color: #707070">&#8358;<?= number_format($get_product['price']);?></td>
												<td style="color: #707070"><?= $value['counter_value'];?></td>
												<td style="color: #707070">&#8358;<?= number_format($value['price']);?></td>
											</tr>
										<?php
										}
									?>
								</tbody>
							</table>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
