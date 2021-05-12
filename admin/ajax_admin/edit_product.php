<?php
	include("../../config/db_class.php");
	// include("../../config/constants.php");
	$object = new DbQueries();
	$product_array = $_POST;
	$edit_product = $object->edit_product($product_array);
	$edit_product_decode = json_decode($edit_product, true);
	if($edit_product_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $edit_product_decode['response']['message'];
	}

?>