<?php

if(isset($_POST['delete_user'])){
	include_once('libs/class_manage_users.php');
	$init = new ManageUsers();
	
	$id= $_POST['id_user'];
			
	
	$delete = $init->deleteUser($id);
	
	if($delete == 1)
	{
		$msg = "Successfuly deleted";
		header("Location: users_list.php");
	}
	else
	{
		$msg = "Could not delete the user";
		header("Location: users_list.php");
		
	}
}


?>