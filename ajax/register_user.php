<?php
	include("../config/db_class.php");
	require_once('../config/constants.php');
	$object = new DbQueries();
	$email = $_POST['email'];
	$table = 'users';
	$register_user = $object->register_user($table, $email);
	$register_user_decode = json_decode($register_user, true);
	if($register_user_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $register_user_decode['response']['message'];
	}
?>