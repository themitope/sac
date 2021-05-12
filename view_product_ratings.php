<?php include('includes/header.php');?>

<body>
	<?php include('includes/navbar1.php');
		// $user_id = $_SESSION['user']['unique_id'];
		// $get_user = $object->get_one_row_from_one_table('users', 'unique_id', $user_id);
		$product_id = (isset($_GET['product_id'])) ? $_GET['product_id'] : '';
		$get_num_ratings = $object->get_number_of_rows_one_param('ratings','product_id',$product_id);
  		$rating = $object->get_average_rating($product_id);
  		$get_ratings = $object->get_rows_from_one_table_by_id('ratings','product_id',$product_id);
	?>
	<section class="ms-5 mt-4 mb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 style="color: #1C174C;">View Customers Rating</h1>
					<div class="card me-3">
						<div class="card-header">
							Customer Feedback
						</div>
						<div class="container mt-3">
							<div class="row">
								<div class="col-md-4">
									<h6>PRODUCT RATINGS (<?php echo $get_num_ratings;?>)</h6>
									<div class="average_rating mt-4 mb-5 text-center">
										<h3><?= number_format($rating, 1).'/5'?></h3>
										<div class="rating">
					                      <input type="radio" name="" value="5" id="5" <?= $rating == 5 ? 'checked' : ''?> disabled>
					                      <label for="5" title="5 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="" value="4" id="4" <?= $rating == 4 ? 'checked' : ''?> disabled>
					                      <label for="4" title="4 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="" value="3" id="3" <?= $rating == 3 ? 'checked' : ''?> disabled>
					                      <label for="3" title="3 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="" value="2" id="2" <?= $rating == 2 ? 'checked' : ''?> disabled>
					                      <label for="2" title="2 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="" value="1" id="1" <?= $rating == 1 ? 'checked' : ''?> disabled>
					                      <label for="1" title="1 star" style="font-size: 20px;">☆</label>
					                  	</div>
										<small><?= $get_num_ratings;?> rating(s)</small>
									</div>
								</div>
								<div class="col-md-8">
									<h6>PRODUCT REVIEWS (<?php echo $get_num_ratings;?>)</h6>
									<?php
										foreach ($get_ratings as $ratings) {
											$get_rating_user = $object->get_one_row_from_one_table('users', 'unique_id', $ratings['user_id']);
											$explode_user = explode(' ', $get_rating_user['fullname']);
									?>
										<div class="rating" style="justify-content: left;">
					                      <input type="radio" name="rating" value="5" id="5" <?= $ratings['rating'] == 5 ? 'checked' : ''?> disabled>
					                      <label for="5" title="5 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="rating" value="4" id="4" <?= $ratings['rating'] == 4 ? 'checked' : ''?> disabled>
					                      <label for="4" title="4 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="rating" value="3" id="3" <?= $ratings['rating'] == 3 ? 'checked' : ''?> disabled>
					                      <label for="3" title="3 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="rating" value="2" id="2" <?= $ratings['rating'] == 2 ? 'checked' : ''?> disabled>
					                      <label for="2" title="2 star" style="font-size: 20px;">☆</label> 
					                      <input type="radio" name="rating" value="1" id="1" <?= $ratings['rating'] == 1 ? 'checked' : ''?> disabled>
					                      <label for="1" title="1 star" style="font-size: 20px;">☆</label>
					                  	</div>
					                  	<div class="mt-4 mb-4">
					                  		<?php echo $ratings['review'];?>
					                  	</div>
					                  	<small class="mt-3"><?= date("d-m-Y", strtotime($ratings['date_created'])).' by '. $explode_user[1];?></small>
					                  	<hr>
									<?php
										}
									?>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php include('includes/footer.php');?>
</body>

<?php include('includes/scripts.php');?>
