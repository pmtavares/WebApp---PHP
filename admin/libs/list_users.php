<?php
	include_once('class_manage_users.php');
	
	$init = new ManageUsers();
	
	if(isset($_GET['id_user']))
	{
		$id = $_GET['id_user'];	
		$list_users = $init->listUser($id);
		
	}
	else{
		$list_users = $init->listUsers();
		
	}


?>