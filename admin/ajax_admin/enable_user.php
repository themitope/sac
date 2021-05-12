<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$enable_user = $object->update_with_one_param('users','unique_id',$unique_id,'status', 1);
	$enable_user_decode = json_decode($enable_user, true);
	if($enable_user_decode['status'] == 1){
		echo "success";
	}else{
		echo $enable_user_decode['msg'];
	}

?>