<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $user_id = $_SESSION['user']['unique_id'];
    $data = ['rating', 'order_id', 'product_id', 'user_id', 'review'];
    $order_id = $_POST['order_id'];
    $object = new DbQueries();
    $submit_rating = $object->insert_into_db('ratings', $data, 'order_id', $order_id);
    $submit_rating_decode = json_decode($submit_rating, true);
    if($submit_rating_decode['status'] == 1){
    	echo "success";
    }
    else{
    	echo $submit_rating_decode['msg'];
    }
?>