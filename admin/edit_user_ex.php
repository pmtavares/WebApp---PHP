<?php

if(isset($_POST['id_user'])){
	include_once('libs/class_manage_users.php');
	$init = new ManageUsers();
	
	$id_user = $_POST['id_user'];
	$name = $_POST['user_name'];
	$surname = $_POST['surname'];
	$ocupation = $_POST['ocupation'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$user_group = $_POST['user_group'];	
	$activated = $_POST['activated'];
	$user_photo = $_POST['user_photo'];		
	
	$edit = $init->editUsers($id_user, $name, $surname, $email, $ocupation, $user_group, $activated, $user_photo);
	
	if($edit == 1)
	{
		$msg = "Successfuly Updated";
		header("Location: edit_user.php?id_user=$id_user&success=$msg");
	}
	else
	{
		$msg = "Could not update";
		header("Location: edit_user.php?id_user=$id_user&success=$msg");
		
	}
}


?>