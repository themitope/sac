<?php
	include("../../config/db_class.php");
	$object = new DbQueries();
	$category_id = $_POST['category_id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$data = ['name', 'description'];
	$edit_category = $object->update_data('category', $data, 'unique_id' ,$category_id);
	$edit_category_decode = json_decode($edit_category, true);
	if($edit_category_decode['status'] == 1){
		echo "success";
	}else{
		echo $edit_category_decode['msg'];
	}

?>