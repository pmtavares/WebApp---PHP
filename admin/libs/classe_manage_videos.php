<?php
	include_once("includes/connect.php");
	
	class ManageVideos{
		public $link;
		
		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();
			return $this->link;
			
		}
		
		function listVideos($status = null){
			if(isset($status))
			{
				$query = $this->link->query("SELECT * FROM videos WHERE activated='$status'");	
				
			}
			else
			{
				$query = $this->link->query("SELECT * FROM videos");	
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
		
		function listInVideo($id_video)
		{
			$id = $id_video;
			$query = $this->link->query("SELECT * FROM videos WHERE id_video = '$id_video' LIMIT 1");	
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
		
		function editVideos($id, $title, $data, $views, $category, $link_video, $user)
		{
			$query = $this->link->query("UPDATE videos SET title_video = '$title', cat_video = '$category', user_video = '$user', views_video='$views', link_video = '$link_video' WHERE id_video='$id'");	
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
		function deleteVideo($id_video){
			$query = $this->link->query("DELETE FROM videos WHERE id_video='$id_video'");	
			$counts = $query->rowCount();
			return $counts;
			
		}
		
	}


?>