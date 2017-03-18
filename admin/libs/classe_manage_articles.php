<?php
	include_once("includes/connect.php");
	
	class ManageArticles{
		public $link;
		
		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();
			return $this->link;
			
		}
		
		function listArticles($status = null){
			if(isset($status))
			{
				$query = $this->link->query("SELECT * FROM articles WHERE activated='$status'");	
				
			}
			else
			{
				$query = $this->link->query("SELECT * FROM articles");	
			}
			$counts = $query->rowCount();
			if($counts > 0)
			{
				$result = $query->fetchAll();	
			}
			else
			{
				$result = $counts;	
			}
			return $result;
		}
		
		function listInArticle($id_article)
		{
			$id = $id_article;
			$query = $this->link->query("SELECT * FROM articles WHERE id_article = '$id_article' LIMIT 1");	
			$counts = $query->rowCount();
			if($counts == 1)
			{
				$result = $query->fetchAll();	
			}
			else
			{
				$result = $counts;	
			}
			return $result;
		}
		
		function editArticles($id, $title, $data, $views, $category, $status)
		{
			$query = $this->link->query("UPDATE articles SET title_article = '$title', cat_article = '$category', views_article='$views', status_article='$status' WHERE id_article='$id'");	
			$counts = $query->rowCount();
			return $counts;
		}
		
		function listCat()
		{
			$query = $this->link->query("SELECT name_cat FROM categories");
			$counts = $query->rowCount();
			if($counts > 0)
			{
				$result = $query->fetchAll();	
			}
			else
			{
				$result = $counts;	
			}
			return $result;
			
		}
		function listStatus(){
			$query = $this->link->query("SELECT desc_status FROM status");
			$counts = $query->rowCount();
			if($counts > 0)
			{
				$result = $query->fetchAll();	
			}
			else
			{
				$result = $counts;	
			}
			return $result;
			
		}
		function deleteArticle($id_article){
			$query = $this->link->query("DELETE FROM articles WHERE id_article='$id_article'");	
			$counts = $query->rowCount();
			return $counts;
			
		}
		
	}


?>