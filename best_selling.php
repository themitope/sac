<?php include('includes/header.php');?>
<body>
<?php include('includes/navbar1.php');
	$get_best_selling = $object->get_rows_from_one_table('best_selling_products');
?>
<div class="best_selling_container">
	<div class="centered">
		<h1 class="text-white" style="font-size: 60px;">Best Selling</h1>
		<p style="color: #F9D30B">If you’re a Woman, you need to have the latest styles that show you know what’s up.<br> These extensions right here are the Hottest things on the market.<br> Choose the Hair Extension you want and we’ll send it to you</p>
	</div>
</div>

<section class="mt-5 mb-5">
	<div class="container">
		<div class="row">
			<?php
				if($get_best_selling == null){
					echo '<div class="text-center">No Best Selling Product now</div>';
				}else{
					foreach ($get_best_selling as $best_selling) {
						$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $best_selling['product_id']);
						$get_category = $object->get_one_row_from_one_table('category', 'unique_id', $get_product['category']);
			?>
			<div class="col-md-3 mb-5">
				<img src="admin/<?= $get_product['product_image']?>" class="img-fluid" style="border-radius: 10px;">
				<h6 class="mt-2"><?= $get_category['name'];?></h6>
				<p class="fw-bold"><?= $get_product['name'];?> <br>
					&#8358;<?= number_format($get_product['price']);?>
				</p>
			</div>
			<?php
				} }
			?>
		</div>
	</div>
</section>

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
</body>
</html>