<?php include('includes/header.php');?>
<body>
<?php include('includes/navbar1.php');
	$get_hot_now = $object->get_rows_from_one_table('hot_now_products');
?>
<div class="hot_now_container">
	<div class="centered">
		<h1 class="text-white" style="font-size: 60px;">Hot Right Now</h1>
		<p style="color: #F9D30B">If you’re a Woman, you need to have the latest styles that show you know what’s up.<br> These extensions right here are the Hottest things on the market. <br>Choose the Hair Extension you want and we’ll send it to you</p>
	</div>
</div>

<section class="mt-5 mb-5">
	<div class="container">
		<div class="row">
			<?php
				if($get_hot_now == null){
					echo '<div class="text-center">No Best Selling Product now</div>';
				}else{
					foreach ($get_hot_now as $hot_now) {
						$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $hot_now['product_id']);
						$get_category = $object->get_one_row_from_one_table('category', 'unique_id', $get_product['category']);
			?>
			<div class="col-md-3">
				<img src="admin/<?= $get_product['product_image']?>" class="img-fluid" style="border-radius: 10px;">
				<h6 class="mt-2"><?= $get_category['name'];?></h6>
				<p class="fw-bold"><?= $get_product['name'];?> <br>
					&#8358;<?= number_format($get_product['price']);?>
				</p>
			</div>
			<?php } }?>
		</div>
	</div>
</section>

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
</body>
</html>