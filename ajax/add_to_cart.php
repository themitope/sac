<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $product_id = $_POST['product_id'];
    $counter_value = $_POST['counter_value'];
    @$color = $_POST['color'];
    $price = $_POST['cal_price'];
    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    $cart_array = [
    	"product_id" => $product_id,
    	"counter_value" => $counter_value,
    	"color" => $color,
    	"price" => $price
    ];
    // echo $price;
    // $array_key = 1000;
    // echo count($cart_items).'<br>';
    // echo $product_id.'<br>';
    $existing = 0;
    if($cart_items != null){
        foreach ($cart_items as $key => $item) {
        	//echo $item['product_id'].'<br>';
        	if($item['product_id'] == $product_id){
        		$existing++;
        		$array_key = $key;
        		// $cart_array['counter_value'] = $cart_array['counter_value'] + $item['counter_value'];
        		// $cart_array['price'] = $item['price'] + $price;

				$cart_array = [
					"product_id" => $product_id,
					"counter_value" => $cart_array['counter_value'] + $item['counter_value'],
					"color" => $color,
					"price" => $item['price'] + $price
				];
        		//$_SESSION['cart'][$key] = $cart_array;
        		
        	}
        	// else{
        	// 	$existing = 0;
        	// 	//$_SESSION['cart'][] = $cart_array;
        	// }
        }


        echo $existing;
        if($existing > 0){
        	// $cart_array['counter_value'] = $cart_array['counter_value'] + $item['counter_value'];
        	// $cart_array['price'] = $item['price'] + $price;
        	$_SESSION['cart'][$array_key] = $cart_array;
        }
        else{
        	$_SESSION['cart'][] = $cart_array;
        }
    }
    else{
    	$_SESSION['cart'][] = $cart_array;
    }
    print_r($_SESSION['cart']);
?>