<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$order_id = $_POST['order_id'];
	$order_status = $_POST['order_status'];
	if($order_status == 1){
		$update_order = $object->update_with_one_param('orders','unique_id',$order_id,'status', $order_status);
	}else if($order_status == 2){
		$update_order = $object->update_with_one_param('orders','unique_id',$order_id,'status', $order_status);
	}
	
	$update_order_decode = json_decode($update_order, true);
	if($update_order_decode['status'] == 1){
		echo "success";
	}else{
		echo $update_order_decode['msg'];
	}

?>