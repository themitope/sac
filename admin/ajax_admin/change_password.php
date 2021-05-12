<?php
    session_start();
    include("../../config/db_class.php");
    $object = new DbQueries();
    $password = $_POST['new_password'];

    $hash = md5($password);

    $confirm_password = $_POST['confirm_password'];
    $old_password = $_POST['old_password'];
    $hash_old_password = md5($old_password);

    $admin_id = $_SESSION['admin']['unique_id'];
    $get_admin = $object->get_one_row_from_one_table('admin', 'unique_id', $admin_id);

    if(empty($password) || empty($confirm_password) || empty($old_password)){
        echo "Empty field(s) found";
    }
    else if($get_admin['password'] != $hash_old_password){
        echo "Incorrect old password";
    }
    else if ($password != $confirm_password){
        echo "Passwords do not match";
    }else{
   
    $update_password = $object->update_with_one_param('admin','unique_id',$admin_id,'password',$hash);
    $update_password_decode = json_decode($update_password, true);
    if($update_password_decode['status'] == "1"){
        echo 200;
    }
    else{
    	echo "Please try again";
    }
}
 ?> 