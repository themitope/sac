<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    $user_id = $_SESSION['user']['unique_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $instagram_handle = $_POST['instagram_handle'];
    $object = new DbQueries();
    $edit_profile = $object->edit_profile($user_id, $first_name, $last_name, $username, $old_password, $new_password, $email, $confirm_password, $instagram_handle);
    $edit_profile_decode = json_decode($edit_profile, true);
    if($edit_profile_decode['response']['status'] == SUCCESS_RESPONSE){
    	echo "success";
    }
    else{
    	echo $edit_profile_decode['response']['message'];
    }
?>