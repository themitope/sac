<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		$prev_page = basename($_SERVER['PHP_SELF']);
		if(!isset($_SESSION['user'])){
			echo '<meta http-equiv="refresh" content="0; url=login?prev_page='.$prev_page.'" />';
			// header("Location: login?prev_page=".$prev_page);
		}
		$shipping_fee = isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee'] : 0;
		$shipping_total = isset($_SESSION['shipping_total']) ? $_SESSION['shipping_total'] : 0;
		$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
		$user_id = $_SESSION['user']['unique_id'];
		$get_user_info = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$get_user_payment_method = $object->get_one_row_from_one_table('payment_method', 'user_id', $user_id);
	?>
	<div class="container mb-5">
		<ul class="steps mt-4">
		  <li class="step step-success">
		    <div class="step-content">
		      <a href="cart"><span class="step-circle"><span class="span_circle"></span></span></a>
		      <span class="step-text mt-2 fw-bold">Shopping Cart</span>
		    </div>
		  </li>
		  <li class="step step-success">
		    <div class="step-content">
		      <a href="checkout"><span class="step-circle"><span class="span_circle"></span></span></a>
		      <span class="step-text fw-bold mt-2">Checkout details</span>
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
				<form id="place_order_form" method="post">
				<div class="row mt-5">
					<!-- <form> -->
						<div class="col-md-4">
							<h6 style="color: #1C174C;" class="fw-bold">SHIPPING DETAILS</h6>
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
						</div>
						<div class="col-md-4">
							<h6 style="color: #1C174C;" class="fw-bold">BILLING DETAILS</h6>
							<form>
								<input type="checkbox" name=""> &nbsp;&nbsp;<small>Same as shipping address</small>
							</form>
							<div class="mt-4">
								<h6 style="color: #1C174C;">ADDITIONAL OPTIONS</h6>
								<p><small class="fw-bold mt-3"> + Add a note to this order</small></p>
								<p><small class="fw-bold mt-3"> + Apply a coupon code</small></p>
							</div>
						</div>
							<div class="col-md-4">
								<h6 style="color: #1C174C;" class="fw-bold">YOUR ORDER</h6>
								<div class="mt-4 table">
									<table class="table align-items-center" id="myTable">
										<thead class="thead-light">
											<tr>
							                    <th colspan="2">PRODUCT</th>
							                    <th scope="col">TOTAL</th>
							                </tr>
										</thead>
										<tbody>
											<?php
												if($cart_items == null){
													echo "No items to checkout";
													$subtotal = 0;
												}
												else{
													$subtotal = 0;
													foreach ($cart_items as $item) {
													$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $item['product_id']);
											?>
											<tr>
												<td colspan="2"><?= $get_product['name'].' '.'&times'.' '.$item['counter_value']?></td>
												<td class="fw-bold">&#8358;<?= number_format($item['price']);?></td>
											</tr>
											<?php $subtotal+=$item['price'];} }?>
										</tbody>
									</table>
									<div class="row">
										<div class="col-md-8">
											<span class="fw-bold">SHIPPING</span>
										</div>
										<div class="col-md-4 mb-2">
											<span class="fw-bold">&#8358;<?= number_format($shipping_fee)?></span>
										</div>
										<hr>
										<div class="col-md-8">
											<span class="fw-bold">TOTAL</span>
										</div>
										<div class="col-md-4">
											<span class="fw-bold">&#8358;<?= number_format($subtotal + $shipping_fee)?></span>
										</div>
										<input type="hidden" name="order_total" value="<?= $subtotal + $shipping_fee;?>">
									</div>
								</div>
								<div class="mt-4">
									<h6 style="color: #4E3883;">PAYMENT METHOD</h6>
										<div class="card payment_card">
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
											  <label class="form-check-label" for="">
											    Direct Bank Transfer
											  </label>
											</div>
											<div class="col-md-12 mt-3">
												<div style="display: none; background-color: #D2D2D2; padding: 10px" id="transfer_instruction">
													<small>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</small>
												</div>
											</div>
										</div>
									<?php
										if($get_user_payment_method == null){
											?>
											<div class="card payment_card mt-3">
												<div class="row">
													<div class="col-md-8">
														<div class="form-check">
														  <input class="form-check-input" type="radio" name="payment_method" id="paystack" value="stripe">
														  <label class="form-check-label" for="">
														    Credit Card (Stripe)
														  </label>
														</div>
													</div>
													<div class="col-md-3">
														<img src="assets/images/image 19.png" class="img-fluid">
													</div>
													<div class="col-md-12 mt-3">
														<div style="display: none; background-color: #D2D2D2; padding: 10px" id="paystack_instruction">
															<small>Make payment using your debit, credit card; bank account</small>
														</div>
													</div>
												</div>
											</div>
											<div class="card payment_card mt-3">
												<div class="row">
													<div class="col-md-8">
														<div class="form-check">
														  <input class="form-check-input" type="radio" name="payment_method" id="flutter" value="flutter">
														  <label class="form-check-label" for="">
														    Credit Card (Flutterwave)
														  </label>
														</div>
													</div>
													<div class="col-md-3">
														<img src="assets/images/image 19.png" class="img-fluid">
													</div>
													<div class="col-md-12 mt-3">
														<div style="display: none; background-color: #D2D2D2; padding: 10px" id="flutter_instruction">
															<small>Make payment using your debit and credit cards</small>
														</div>
													</div>
												</div>
											</div>
										<?php
										}else{
											?>
											<div class="card payment_card mt-3">
												<div class="row">
													<div class="col-md-8">
														<div class="form-check">
														  <input class="form-check-input" type="radio" name="payment_method" id="flutter" value="<?= $get_user_payment_method['payment_method']?>">
														  <label class="form-check-label" for="">
														    Credit Card
														    <?php
														    	if($get_user_payment_method['payment_method'] == 'stripe'){
														    		echo '(Stripe)';
														    	}else if($get_user_payment_method['payment_method'] == 'flutter'){
														    		echo '(Flutterwave)';
														    	}
														    ?>
														  </label>
														</div>
													</div>
													<div class="col-md-3">
														<img src="assets/images/image 19.png" class="img-fluid">
													</div>
													<div class="col-md-12 mt-3">
														<div style="display: none; background-color: #D2D2D2; padding: 10px" id="flutter_instruction">
															<small>Make payment using your debit and credit cards</small>
														</div>
													</div>
												</div>
											</div>
										<?php	
										}
									?>
									<div class="mt-3">
										<div class="form-check">
										  <input class="" type="checkbox" value="" id="agree_terms" class="agree_terms">
										  <span> &nbsp;&nbsp;
										    <small>I have read and agreed to the website terms and conditions</small>
										  </span>
										</div>
									</div>
									<div class="mt-4">
										<small style="color: #393E46;" class="fw-bold">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</small>
									</div>
									<div class="d-grid gap-2 mt-3">
					              		<button class="mt-3 btn btn-block btn-lg" type="button" style="background-color: #1C174C; color: #fff" id="place_order_btn">Place Order</button>
					              	</div>
					        	</div>
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#bank_transfer").click(function(){
			$("#transfer_instruction").show();
			$("#paystack_instruction").hide();
			$("#flutter_instruction").hide();
		});
		$("#paystack").click(function(){
			$("#transfer_instruction").hide();
			$("#paystack_instruction").show();
			$("#flutter_instruction").hide();
		});
		$("#flutter").click(function(){
			$("#transfer_instruction").hide();
			$("#paystack_instruction").hide();
			$("#flutter_instruction").show();
		});
	});
</script>
