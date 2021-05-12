<?php
	session_start();
	include("../../config/db_class.php");
	$object = new DbQueries();
	$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
	$add_best_selling = $object->add_best_selling_products($product_id);
	$add_best_selling_decode = json_decode($add_best_selling, true);
	if($add_best_selling_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $add_best_selling_decode['response']['message'];
	}

?>