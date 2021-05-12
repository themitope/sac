<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$category_id = $_POST['category_id'];
	$delete_category = $object->delete_a_row('category', 'unique_id', $category_id);
	//$delete_product_decode = json_decode($delete_product, true);
	if($delete_category){
		$object->delete_a_row('products', 'category', $category_id);
		echo "success";
	}else{
		echo "Please try again";
	}

?>