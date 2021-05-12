<?php include('includes/header.php');?>
<body>

<?php 
// session_start();
// session_destroy();
	include('includes/navbar1.php');
	$product_id = (isset($_GET['product_id']))? $_GET['product_id'] : '';
  	$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $product_id);
  	$product_image = explode(',', $get_product['image_url']);
  	$colors = explode(',', $get_product['colours']);
  	$get_category = $object->get_one_row_from_one_table('category', 'unique_id', $get_product['category']);
  	$get_category_products = $object->get_rows_from_one_table_by_id('products','category', $get_product['category']);
  	$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
  	$get_num_ratings = $object->get_number_of_rows_one_param('ratings','product_id',$product_id);
  	$rating = $object->get_average_rating($product_id);
?>

<div class="container mt-5 mb-5">
	<div class="card" style="border-radius: 10px;">
		<div class="row">
			<div class="col-md-6">
				<div class="container mt-3 mb-3">
					<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
					  <div class="carousel-indicators">
					  	<img src="admin/<?= $get_product['product_image'];?>"  data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active all" aria-current="true" aria-label="Slide 1">
					  	<?php
					    	for ($image=0; $image < count($product_image); $image++) { 
						  		// echo $product_image[$image];
					    ?>
					    <img src="admin/<?= $product_image[$image];?>"  data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $image + 1?>" class="all" aria-current="true" aria-label="Slide <?= $image + 2?>">
						<?php } ?>
					  </div>
					  <div class="carousel-inner">
					  	<div class="carousel-item active">
					      <img src="admin/<?= $get_product['product_image'];?>" class="d-block w-100" alt="..." style="border-radius: 10px">
					    </div>
					    <?php
					    	for ($image=0; $image < count($product_image); $image++) { 
						  		// echo $product_image[$image];
					    ?>
					    <div class="carousel-item">
					      <img src="admin/<?= $product_image[$image];?>" class="d-block w-100" alt="..." style="border-radius: 10px">
					    </div>
						<?php }?>
					  </div>
					  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Previous</span>
					  </button>
					  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Next</span>
					  </button>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="container mt-3 mb-3">
					<h6 class="fw-bold"><?= $get_product['sub_category'];?></h6>
					<h4 class="fw-bold mt-3"><?= $get_product['name'];?></h4>
					<h2 class="mt-3" id="">&#8358;<?= number_format($get_product['price']);?></h2>
					<div class="mt-4 d-flex">
					<div class="rating">
                      <input type="radio" name="rating" value="5" id="5" <?= $rating == 5 ? 'checked' : ''?> disabled>
                      <label for="5" title="5 star" style="font-size: 20px;">☆</label> 
                      <input type="radio" name="rating" value="4" id="4" <?= $rating == 4 ? 'checked' : ''?> disabled>
                      <label for="4" title="4 star" style="font-size: 20px;">☆</label> 
                      <input type="radio" name="rating" value="3" id="3" <?= $rating == 3 ? 'checked' : ''?> disabled>
                      <label for="3" title="3 star" style="font-size: 20px;">☆</label> 
                      <input type="radio" name="rating" value="2" id="2" <?= $rating == 2 ? 'checked' : ''?> disabled>
                      <label for="2" title="2 star" style="font-size: 20px;">☆</label> 
                      <input type="radio" name="rating" value="1" id="1" <?= $rating == 1 ? 'checked' : ''?> disabled>
                      <label for="1" title="1 star" style="font-size: 20px;">☆</label>
                  	</div>
					<a href="view_product_ratings?product_id=<?= $product_id;?>" class="mt-1"><?= $get_num_ratings.' rating(s)'?></a>
						</div>
					<form>
						<div class="d-flex mt-4">
							<h4 class="me-4">COLOR</h4>
							<select class="form-control" style="width: 35%" id="color">
								<option value="">Choose an option</option>
								<?php
									foreach ($colors as $color) { 
								?>
									<option value="<?php echo $color;?>"><?php echo $color;?></option>
								<?php }?>
							</select>
						</div>
						<div class="mt-5">
							<p style="color: #12B500">In stock</p>
							<div>
					          <button type="button" class="me-2 btn" id="decrement_counter2" style="padding: 10 15px 10 15px!important; height: 10%; background-color: #B4B4B4;">&minus;</button>
					           <span class="fw-bold" id="counter_value2">1</span> 
					           <button type="button" class="btn ms-2" id="increment_counter2" style="padding: 10 15px 10 15px!important; height: 10%; background-color: #B4B4B4;">&plus;</button>
					           <button style="background-color: #F2B101; color: #fff;" type="button" class="btn ms-2 add_to_cart">Add to cart</button>
					           <input type="hidden" name="product_id" id="product_id" value="<?= $product_id;?>">
					         </div>
						</div>
					</form>
					<div class="mt-5">
						<p>SKU: <?= ($get_product['sku'] != '') ? $get_product['sku'] : 'N/A';?></p>
						<p>Category: <?= $get_category['name'];?></p>
						<p>Tags: Braids, Crochet, Crochet Braids, Gipsy locs, Locs, Naija braids, Nigerian hairstyles</p>
					</div>
					<div class="mt-5">
						<div class="d-flex">
							<?php
								$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							?>
							<a href="https://www.facebook.com/sharer.php?u=<?= $actual_link;?>" target="_blank">
								<span style="color: #3870C0;">
									<i class="fab fa-facebook fa-2x me-3"></i>
								</span>
							</a>
							<a href="https://twitter.com/share?url=<?= $actual_link;?>" target="_blank">
								<span style="color: #2FBBE1;">
									<i class="fab fa-twitter-square fa-2x me-3"></i>
								</span>
							</a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $actual_link;?>" target="_blank">
								<span style="color: #0E76A8;">
									<i class="fab fa-linkedin fa-2x me-3"></i>
								</span>
							</a>
							<a href="https://pinterest.com/pin/create/button/?url=<?= $actual_link;?>" target="_blank">
								<span style="color: #EF2F36;">
									<i class="fab fa-pinterest fa-2x me-3"></i>
								</span>
							</a>
							<a href="mailto:enteryour@addresshere.com?subject=<?= $get_product['name'];?>&;body=Check this out: <?= $actual_link;?>" target="_blank">
								<span style="color: #6F3EA2;">
									<i class="fas fa-envelope fa-2x me-3"></i></i>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card mt-4" style="border-radius: 10px;">
		<nav>
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    <button class="nav-link ms-2 active fw-bold" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="font-size: 15px;">Description</button>
		    <button class="nav-link fw-bold" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Information</button>
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  	<!-- <h6 class="ms-4">Hair Specifications</h6>  -->
		  	<p class="ms-4">
		  		<?= $get_product['description'];?>
		  	</p>
		  </div>
		  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		  	<div class="container">
		  		<table class="table table-responsive align-items-center">
			  		<tr>
			  			<td class="fw-bold">WEIGHT</td>
			  			<td><?= ($get_product['weight'] != '') ? $get_product['weight'] : 'N/A';?></td>
			  		</tr>
			  		<tr>
			  			<td class="fw-bold">DIMENSIONS</td>
			  			<td><?= ($get_product['dimensions'] != '') ? $get_product['dimensions'] : 'N/A';?></td>
			  		</tr>
			  		<tr>
			  			<td class="fw-bold">COLOR</td>
			  			<td><?= $get_product['colours'];?></td>
			  		</tr>
			  	</table>
		  	</div>
		  </div>
		</div>
	</div>
	<div class="mt-4 card" style="border-radius: 10px">
		<div class="container mt-3">
			<h6>Related Products</h6>
			<div class="row mt-5 text-center">
				<?php
					foreach ($get_category_products as $category_product) {
						if($category_product['unique_id'] != $product_id){
				?>
						<div class="col-md-2">
							<img src="admin/<?= $category_product['product_image'];?>" class="img-fluid" style="border-radius: 10px;">
							<p class="" style="color: #707070;"><?= $category_product['name']?><br>
								<span class="fw-bold text-dark">&#8358;<?= number_format($category_product['price']);?></span>
							</p>
						</div>
				<?php } }?>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="no_cart_item" value="<?= count($cart_items);?>">
<input type="hidden" id="price" value="<?= $get_product['price'];?>">

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
<script>
  $(document).ready(function(){
    $("#increment_counter2").click(function(){
      var counter_value = $("#counter_value2").html();
      counter_value++;
      $("#counter_value2").html(counter_value);
    });

    $("#decrement_counter2").click(function(){
      var counter_value = $("#counter_value2").html();
      if(counter_value != 1){
        counter_value--;
        $("#counter_value2").html(counter_value);
      }
    });
    if($("#no_cart_item").val() >= 1){
    	$("#mySidebar1").show();
    }
  });
</script>
</body>