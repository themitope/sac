<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $shipping_id = isset($_POST['shipping_id']) ? $_POST['shipping_id'] : '';
    $object = new DbQueries();
    $get_shipping_price = $object->get_one_row_from_one_table('shipping_location','unique_id',$shipping_id);
    if($get_shipping_price == null){
    	echo 0;
    }
    else{
    	echo (int) $get_shipping_price['shipping_fee'];
    }
?>