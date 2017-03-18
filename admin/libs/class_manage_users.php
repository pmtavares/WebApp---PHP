<?php
	include_once("includes/connect.php");
	
	class ManageUsers{
		public $link;
		
		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();
			return $this->link;
			
		}
		function listUsers($status = null){
			if(isset($status))
			{
				$query = $this->link->query("SELECT * FROM users WHERE activated='$status'");	
				
			}
			else
			{
				$query = $this->link->query("SELECT * FROM users");	
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
		
		function listUser($id, $status = null){
			if(isset($status))
			{
				$query = $this->link->query("SELECT * FROM users WHERE id_user='$id' AND activated='$status'");	
				
			}
			else
			{
				$query = $this->link->query("SELECT * FROM users WHERE id_user='$id'");	
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
		
		function editUsers($id, $name, $surname, $email, $ocupation, $userGroup, $activated, $photo)
		{
			$query = $this->link->query("UPDATE users SET name = '$name', surname = '$surname', ocupation = '$ocupation', email='$email', user_group='$userGroup', activated = '$activated', user_photo ='$photo'  WHERE id_user='$id'");	
			$counts = $query->rowCount();
			return $counts;
		}
		
		function deleteUser($id){
			$query = $this->link->query("DELETE FROM users WHERE user_group != 'Admin' AND id_user='$id'");	
			$counts = $query->rowCount();
			return $counts;
			
		}
		
	}


?>