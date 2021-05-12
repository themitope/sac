<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $user_id = $_SESSION['user']['unique_id'];
    $payment_method = $_POST['payment_method'];
    $object = new DbQueries();
    $add_user_payment_method = $object->add_user_payment_method($user_id, $payment_method);
    $add_user_payment_method_decode = json_decode($add_user_payment_method, true);
    if($add_user_payment_method_decode['response']['status'] == SUCCESS_RESPONSE){
    	echo "success";
    }
    else{
    	echo $add_user_payment_method_decode['response']['message'];
    }
?>