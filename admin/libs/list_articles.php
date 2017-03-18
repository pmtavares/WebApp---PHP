<?php
	include_once('./libs/classe_manage_articles.php');
	$init = new ManageArticles();
	
	if(isset($_GET['id_article']))
	{
		$id = $_GET['id_article'];	
		$list_articles = $init->listInArticle($id);
		$list_categories = $init->listCat();
		$list_status = $init->listStatus();
	}
	else
	{
		$list_articles = $init->listArticles();
		$list_categories = $init->listCat();
		$list_status = $init->listStatus();
	}

?>