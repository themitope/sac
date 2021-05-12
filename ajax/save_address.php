<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $user_id = $_SESSION['user']['unique_id'];
    $fullname = $_POST['fullname'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $object = new DbQueries();
    $save_address = $object->save_address($user_id, $fullname, $country, $address, $postcode, $email, $phone);
    $save_address_decode = json_decode($save_address, true);
    if($save_address_decode['response']['status'] == SUCCESS_RESPONSE){
    	echo "success";
    }
    else{
    	echo $save_address_decode['response']['message'];
    }
?>