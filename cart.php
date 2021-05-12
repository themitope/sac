<?php include('includes/header.php');?>

<body>
	<?php 
		include('includes/navbar1.php');
		$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
		$location = isset($_SESSION['location']) ? $_SESSION['location'] : '';
		$get_location = $object->get_rows_from_one_table_by_one_param('shipping_location', 'town', $location);
	?>
	<div class="container mb-5">
		<ul class="steps mt-4">
		  <li class="step step-success">
		    <div class="step-content">
		      <a href="cart"><span class="step-circle"><span class="span_circle"></span></span></a>
		      <span class="step-text mt-2 fw-bold">Shopping Cart</span>
		    </div>
		  </li>
		  <li class="step">
		    <div class="step-content">
		      <span class="step-circle"></span>
		      <span class="step-text fw-bold mt-2">Checkout Details</span>
		    </div>
		  </li>
		  <li class="step">
		    <div class="step-content">
		      <span class="step-circle"></span>
		      <span class="step-text fw-bold mt-2">Order Complete</span>
		    </div>
		  </li>
		</ul>

		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="row mt-5">
					<div class="col-md-8">
						<h6 style="color: #1C174C;" class="fw-bold">PRODUCT</h6>
						<?php
						// echo md5(uniqid());
						$subtotal_all = 0;
							if($cart_items != null){
								$subtotal_all = 0;
								foreach ($cart_items as $item) {
									$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $item['product_id']);
									$subtotal = $get_product['price'] * $item['counter_value'];
						?>
									<div class="row mb-5">
										<div class="col-md-5">
											<img src="admin/<?= $get_product['product_image'];?>" class="img-fluid" style="border-radius: 10px;">
										</div>
										<div class="col-md-6">
											<table class="table align-items-center" id="myTable">
												<thead class="thead-light">
													<tr style="color: #707070">
														<th>PRICE</th>
														<th>QUANTITY</th>
														<th>SUBTOTAL</th>
													</tr>
												</thead>
												<tbody>
													<tr style="color: #707070">
														<td>&#8358;<?php echo number_format($get_product['price'])?></td>
														<td>
															<button type="button" class="me-2 btn btn-warning decrement_counter" id="<?= $item['product_id'];?>" style="padding: 0 10px 0 10px!important; height: 5%;">&minus;</button>
															<span class="fw-bold" id="counter_value1<?= $item['product_id'];?>"><?= $item['counter_value']?></span> 
															<button type="button" class="btn ms-2 add_button increment_counter" id="<?= $item['product_id'];?>">&plus;</button>
														</td>
														<td>
															&#8358;<span id="increment_price1<?= $item['product_id'];?>"><?php echo number_format($subtotal)?></span>
															<span id="increment_price_hidden<?= $item['product_id'];?>" style="display: none"><?= $get_product['price'];?></span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								<?php $subtotal_all+=$item['price'];}
							}
							?>
					</div>
					<div class="col-md-4" style="border-left: 1px solid #707070;">
						<h6 style="color: #1C174C;" class="fw-bold">CART TOTALS</h6>
						<table class="table align-items-center mt-4" id="myTable">
							<tbody>
								<tr style="color: #707070">
									<td style="color: #1C174C;">Subtotal</td>
									<td></td>
									<td></td>
									<td>
										&#8358;<span id="increment_price2"><?php echo number_format($subtotal_all)?></span>
										<input type="hidden" id="subtotal_all" value="<?= $subtotal_all?>">
									</td>
								</tr>
							</tbody>
						</table>
						<?php
							if($location == ''){
						?>
						<div>Please choose location</div>
					<?php }else{?>
						<small>Shipping from <?= $location;?> City</small>
						<form id="proceed_to_checkout_form" method="post">
							<div class="">
								<div class="form-check">
								  <input class="form-check-input shipping_method" type="radio" name="shipping_method">
								  <label class="form-check-label" for="">
								    <small>Local pickup (Contact Us at least 24 Hrs Before Pick Up)</small>
								  </label>
								</div>
							</div>
							<div id="location_div">
								<?php
									foreach ($get_location as $value) {
								?>
									<div class=" mt-3">
										<div class="form-check">
										  <input class="form-check-input shipping_method" type="radio" name="shipping_method" id="<?= $value['unique_id'];?>" value="<?= $value['unique_id'];?>" required>
										  <label class="form-check-label" for="">
										    <small>Same Day Delivery (<?= $value['delivery_location'];?>) if Order is before 12 Noon otherwise next Day: <span class="fw-bold">&#8358;<?= number_format($value['shipping_fee']);?></span></small>
										  </label>
										</div>
									</div>
								<?php } ?>
								<input type="hidden" name="shipping_total" id="shipping_total" value="">
							</div>
							<small style="cursor: pointer; color: #1C174C;" id="change_address">Change Address</small>
							<div style="display: none; background-color: #D2D2D2; padding: 10px" id="change_address_div">
								<form id="change_address_form">
									<select class="form-control change_address">
										<option value="">Select an option</option>
										<option value="Lagos">Lagos</option>
										<option value="Port-Harcourt">Port-Harcourt</option>
									</select>
									<!-- <div class="d-grid gap-2">
			              				<button class="mt-3 btn btn-block" style="background-color: #1C174C; color: #fff">Update</button>
			              			</div> -->
								</form>
							</div>
							<table class="table align-items-center mt-4" id="myTable">
							<tbody>
								<tr style="color: #707070">
									<td>Total</td>
									<td></td>
									<td></td>
									<td>
										&#8358;<span id="total_price"><?= $subtotal_all;?></span>
									</td>
								</tr>
							</tbody>
						</table>
							<div class="d-grid gap-2 mt-3">
			              		<button class="mt-3 btn btn-block" style="background-color: #1C174C; color: #fff" id="proceed_to_checkout_btn">Proceed to Checkout</button>
			              	</div>
						</form>
						<?php
							}
						?>
						<div class="mt-3" style="color: #707070">
							<span>Coupon</span>
							<form id="coupon_code_form" class="mt-3">
								<input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon Code" class="form-control">
								<div class="d-grid gap-2 mt-3">
			              			<button class="mt-3 btn btn-block" style="background-color: #C7C7C7; color: #fff">Apply Coupon</button>
			              		</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
<script>
  $(document).ready(function(){
    // $(".increment_counter1").click(function(){
    // 	var id= $(this).attr("id");
    //   var counter_value = $("#counter_value1"+id).html();
    //   var price = $("#increment_price_hidden1"+id).html();
    //   counter_value++;
    //   var new_price = price * counter_value;
    //   $("#counter_value1"+id).html(counter_value);
    //   $("#increment_price1"+id).html(new_price);
    //   $("#increment_price2").html(new_price);
    // });

    // $(".decrement_counter1").click(function(){
    //   var counter_value = $("#counter_value1").html();
    //   var price = $("#increment_price_hidden1").html();
    //   if(counter_value != 1){
    //     counter_value--;
    //     var new_price = price * counter_value;
    //     $("#counter_value1").html(counter_value);
    //     $("#increment_price1").html(new_price);
    //     $("#increment_price2").html(new_price);
    //   }
    // });

    $("#change_address").click(function(){
    	$("#change_address_div").toggle();
    });
  });
</script>
