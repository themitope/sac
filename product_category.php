<?php 
include('includes/header.php');?>
<body>

<?php 
	// session_start();
	include('includes/navbar1.php');
	include('includes/navbar2.php');
	$category_id = (isset($_GET['category_id']))? $_GET['category_id'] : '';
  	$get_category = $object->get_one_row_from_one_table('category', 'unique_id', $category_id);
  	$get_products = $object->get_rows_from_one_table_by_id('products','category',$category_id);
?>

<div class="container">
	<h3 style="color: #1C174C" class="mt-3"><?= $get_category['name'];?></h3>
	<div class="card mt-5 mb-5" style="border-radius: 10px;">
		<div class="container">
			<div class="row mt-3 mb-3">
				<?php
					if($get_products != null){
						foreach ($get_products as $products) {
				?>
						<div class="col-md-4">
							<a href="product?product_id=<?= $products['unique_id'];?>">
								<div class="card" style="border-radius: 10px">
			                      	<img src="admin/<?= $products['product_image'];?>" style="border-radius: 10px" class="category_product_image">
									<div class="out_of_stock" style="display: none;" id="out_of_stock">
										<h3 class="text-dark text-center">OUT OF STOCK</h3>
									</div>
			                    </div>
							</a>
							<center>
	                          <h6 style="color: #707070" class="text-uppercase"><?= $products['sub_category'];?></h4>
	                          <h5 class="text-uppercase"><a style="color: #1C174C; text-decoration: none;" href="product?product_id=<?= $products['unique_id'];?>"><?= $products['name'];?></a></h5>
	                          <p class="fw-bold">&#8358;<?= number_format($products['price']);?></p>
	                        </center>
	                        <input type="hidden" name="" id="no_of_product" value="<?= $products['available_no'];?>">
						</div>
				<?php } } 
				?>
			</div>
		</div>
	</div>
</div>


<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
<script type="text/javascript">
	$(document).ready(function(){
		var available_no = $("#no_of_product").val();
		if(available_no < 1){
			$("#out_of_stock").show();
		}
	});
</script>
</body>