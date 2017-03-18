<?php
	include_once('./libs/classe_manage_videos.php');
	$init = new ManageVideos();
	
	if(isset($_GET['id_video']))
	{
		$id = $_GET['id_video'];	
		$list_videos = $init->listInVideo($id);
		$list_categories = $init->listCat();
		$list_status = $init->listStatus();
	}
	else
	{
		$list_videos = $init->listVideos();
		$list_categories = $init->listCat();
		$list_status = $init->listStatus();
	}

?>