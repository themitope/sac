<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$user_id = $_SESSION['user']['unique_id'];
		$get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_count_user_order = $object->get_number_of_rows_one_param('orders','user_id',$user_id);
		$get_user_order = $object->get_rows_from_one_table_by_id('orders', 'user_id',$user_id);
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
				<h1 style="color: #1C174C;">Orders</h1>
				<p>Hello, see your orders here</p>
				<div class="card me-3">
					<div class="container mt-3">
						<?php
							if($get_user_order == null){
						?>
						<div class="row justify-content-center mb-5">
							<i class="fas fa-clipboard-list fa-5x" style="color: #C7C7C7;"></i>
							<p style="color: #C7C7C7" class="text-center">No orders yet</p>
							<a class="text-center" href="index"><button class="btn" style="background-color: #1C174C; color: #fff">Browse Products</button></a>
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
										<th>TOTAL</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($get_user_order as $value) {
											$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $value['product_id']);
										?>
											<tr class="mb-5">
												<td style="color: #707070">
													<img src="admin/<?= $get_product['product_image'];?>" style="border-radius: 10px;"><br>
													<small style="color: #707070"><?= $get_product['name'];?></small>
												</td>
												<td style="color: #707070">&#8358;<?= number_format($get_product['price']);?></td>
												<td style="color: #707070"><?= $value['quantity'];?></td>
												<td style="color: #707070">&#8358;<?= number_format($value['subtotal']);?></td>
												<td>
													<?php
														if($value['status'] == 0){
															echo '<span class="text-primary">New</span>';
														}
														else if($value['status'] == 1){
															echo '<span class="text-warning">In Process</span>';
														}
														else if($value['status'] == 2){
															echo '<span class="text-success">Delivered</span>';
														}
													?>
												</td>
												<td>
													<?php
													if($value['status'] == 2){
														$get_ratings = $object->get_one_row_from_one_table_by_two_params('ratings','user_id',$user_id,'product_id', $value['product_id']);
														if($get_ratings == null){
															?>
														<a href="submit_rating?order_id=<?php echo $value['unique_id']?>" class="btn btn-sm btn-primary">Submit Rating</a>
													<?php }else{?>
														<a href="view_rating?order_id=<?php echo $value['unique_id']?>" class="btn btn-sm btn-primary">View Rating</a>
													<?php } }?>
												</td>
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
