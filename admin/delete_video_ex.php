<?php

if(isset($_POST['delete_video'])){
	include_once('libs/classe_manage_videos.php');
	$init = new ManageVideos();
	
	$id= $_POST['id_video'];
	$title = $_POST['title_video'];
	$data = $_POST['date_posted'];
	$views = $_POST['views'];
	$category = $_POST['cat_video'];		
	
	$delete = $init->deleteVideo($id);
	
	if($delete == 1)
	{
		$msg = "Successfuly deleted";
		header("Location: videos_list.php");
	}
	else
	{
		$msg = "Could not delete";
		header("Location: videos_list.php");
		
	}
}


?>