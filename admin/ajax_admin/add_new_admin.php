<?php
	session_start();
	include("../../config/db_class.php");
	$object = new DbQueries();
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$admin_id = $_SESSION['admin']['unique_id'];
	$add_new_admin = $object->add_new_admin($fullname, $email, $admin_id);
	$add_new_admin_decode = json_decode($add_new_admin, true);
	if($add_new_admin_decode['response']['status'] == SUCCESS_RESPONSE){
		echo "success";
	}else{
		echo $add_new_admin_decode['response']['message'];
	}

?>