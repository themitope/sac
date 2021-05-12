<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $product_id = $_POST['product_id'];
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;

    //echo $product_id.'<br>';
    $existing = 0;
    if($cart_items != null){
        foreach ($cart_items as $key => $item) {
        	//echo $item['product_id'].'<br>';
        	if($item['product_id'] == $product_id){
        		$existing++;
        		echo $array_key = $key;
        	}
        }
        //echo $existing;
        if($existing > 0){
            //array_splice($_SESSION['cart'], $array_key);
            unset($_SESSION['cart'][$array_key]);

        }
    }
    print_r($_SESSION['cart']);
?>