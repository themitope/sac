<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$delete_hot_now = $object->delete_a_row('hot_now_products', 'unique_id', $unique_id);
	if($delete_hot_now){
		echo "success";
	}else{
		echo "Please try again";
	}

?>