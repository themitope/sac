<?php session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $username_or_email = $_POST['username_or_email'];
	$password = $_POST['password'];
	$object = new DbQueries();
	$check_user_login =  $object->check_user_login($username_or_email, $password);
	if($check_user_login == null){
		echo "Incorrect email or password";
	}
	else if($check_user_login == "empty_fields"){
		echo "Empty field(s) found";
	}
	else{
		echo "success";
		$_SESSION['user'] = $check_user_login;
	}
	
   
?>