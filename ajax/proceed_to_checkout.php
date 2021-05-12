<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $shipping_method = $_POST['shipping_method'];
    echo $shipping_total = $_POST['shipping_total'];
    $object = new DbQueries();
    $get_shipping = $object->get_one_row_from_one_table('shipping_location', 'unique_id', $shipping_method);
    $shipping_fee = $get_shipping['shipping_fee'];
    $_SESSION['shipping_fee'] = $shipping_fee;
    $_SESSION['shipping_total'] = $shipping_total; 
?>