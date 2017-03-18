<?php

if(isset($_POST['id_article'])){
	include_once('libs/classe_manage_articles.php');
	$init = new ManageArticles();
	
	$id= $_POST['id_article'];
	$title = $_POST['title_article'];
	$data = $_POST['date_posted'];
	$views = $_POST['views'];
	$category = $_POST['cat_article'];
	$status = $_POST['status'];		
	
	$edit = $init->editArticles($id, $title, $data, $views, $category, $status);
	
	if($edit == 1)
	{
		$msg = "Successfuly Updated";
		header("Location: edit_article.php?id_article=$id&success=$msg");
	}
	else
	{
		$msg = "Could not update";
		header("Location: edit_article.php?id_article=$id&success=$msg");
		
	}
}


?>