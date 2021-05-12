<?php
	session_start();
	include("../../config/db_class.php");
	$object = new DbQueries();
	$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
	$add_hot_now_products = $object->add_hot_now_products($product_id);
	$add_hot_now_products_decode = json_decode($add_hot_now_products, true);
	if($add_hot_now_products_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $add_hot_now_products_decode['response']['message'];
	}

?>