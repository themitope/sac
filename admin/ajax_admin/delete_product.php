<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$product_id = $_POST['product_id'];
	$get_product = $object->get_one_row_from_one_table('products', 'unique_id', $product_id);
	$product_images = explode(',', $get_product['image_url']);
	$delete_product = $object->delete_a_row('products', 'unique_id', $product_id);
	//$delete_product_decode = json_decode($delete_product, true);
	if($delete_product){
		echo "success";
		unlink("../".$get_product['product_image']);
		for ($image=0; $image < count($product_images); $image++) {
			unlink("../".$product_images[$image]);
		}
	}else{
		echo "Please try again";
	}

?>