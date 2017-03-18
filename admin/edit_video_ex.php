<?php

if(isset($_POST['edit_video'])){
	include_once('libs/classe_manage_videos.php');
	$init = new ManageVideos();
	
	$id= $_POST['id_video'];
	$title = $_POST['title_video'];
	$data = $_POST['date_posted'];
	$user = $_POST['user'];
	$views = $_POST['views'];
	$category = $_POST['cat_video'];
	$status = $_POST['status'];		
	
	$edit = $init->editVideos($id, $title, $data, $views, $category, $status, $user);
	
	if($edit == 1)
	{
		$msg = "Successfuly Updated";
		header("Location: edit_video.php?id_video=$id&success=$msg");
	}
	else
	{
		$msg = "Could not update";
		header("Location: edit_video.php?id_video=$id&error=$msg");
		
	}
}


?>