<?php
	include("../../config/db_class.php");
	// include("../../config/constants.php");
	$object = new DbQueries();
	$product_array = $_POST;
	$add_product = $object->add_product($product_array);
	$add_product_decode = json_decode($add_product, true);
	if($add_product_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $add_product_decode['response']['message'];
	}

?>