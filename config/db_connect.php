<?php
 
class Database{
	
	public $connection;
 
	public function toconnect(){

		$this->connection = mysqli_connect('localhost', 'root', '', 'sac_db');
		if(mysqli_connect_error()){
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
	}

}
 
?>