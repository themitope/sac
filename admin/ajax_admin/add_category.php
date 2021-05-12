<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$table = 'category';
	$data = ['name', 'description'];
	$param = 'name';
	$validate_value = $_POST['name'];
	$add_category = $object->insert_into_db($table,$data,$param,$validate_value);
	$add_category_decode = json_decode($add_category, true);
	if($add_category_decode['status'] == 1){
		echo "success";
	}else{
		echo $add_category_decode['msg'];
	}

?>