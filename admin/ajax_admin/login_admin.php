<?php session_start();
    include("../../config/db_class.php");
    // require_once('../config/constants.php');
    $email = $_POST['email'];
	$password = $_POST['password'];
	$object = new DbQueries();
	$check_admin_login =  $object->check_admin_login($email,$password);
	if($check_admin_login == null){
		echo "Incorrect email or password";
	}
	else if($check_admin_login == "empty_fields"){
		echo "Empty field(s) found";
	}
	else{
		echo "success";
		$_SESSION['admin'] = $check_admin_login;
	}
	
   
?>