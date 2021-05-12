<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$unique_id = $_POST['unique_id'];
	$disable_user = $object->update_with_one_param('users','unique_id',$unique_id,'status', 0);
	$disable_user_decode = json_decode($disable_user, true);
	if($disable_user_decode['status'] == 1){
		echo "success";
	}else{
		echo $disable_user_decode['msg'];
	}

?>