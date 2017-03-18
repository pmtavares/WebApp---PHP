<?php

if(isset($_POST['delete_article'])){
	include_once('libs/classe_manage_articles.php');
	$init = new ManageArticles();
	
	$id= $_POST['id_article'];
	$title = $_POST['title_article'];
	$data = $_POST['date_posted'];
	$views = $_POST['views'];
	$category = $_POST['cat_article'];
	$status = $_POST['status'];		
	
	$delete = $init->deleteArticle($id);
	
	if($delete == 1)
	{
		$msg = "Successfuly deleted";
		header("Location: articles_list.php");
	}
	else
	{
		$msg = "Could not delete";
		header("Location: articles_list.php");
		
	}
}


?>