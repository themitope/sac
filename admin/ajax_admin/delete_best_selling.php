<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$delete_best_selling = $object->delete_a_row('best_selling_products', 'unique_id', $unique_id);
	if($delete_best_selling){
		echo "success";
	}else{
		echo "Please try again";
	}

?>