<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		unset($_SESSION['cart']);
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
		      <span class="step-text mt-2 fw-bold">Checkout Details</span>
		    </div>
		  </li>
		  <li class="step step-success">
		    <div class="step-content">
		      <a href="order_complete"><span class="step-circle"><span class="span_circle"></span></span></a>
		      <span class="step-text mt-2 fw-bold">Order Complete</span>
		    </div>
		  </li>
		</ul>
		<div class="row justify-content-center mt-5" style="text-align: center">
			<div class="col-md-6">
				<h6 style="color: #1C174C;" class="fw-bold">ORDER COMPLETE</h6>
				<p>Your order has been successfully completed</p>
				<span><i class="fas fa-check-circle fa-3x" style="color: #12B500; font-size: 100px;"></i></span>
			</div>
			<div class="d-grid gap-2 mt-3">
          		<a href="index"><button class="mt-3 btn btn-block" style="background-color: #1C174C; color: #fff">Continue Shopping</button><a>
          	</div>
		</div>
	</div>
	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
