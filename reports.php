<?php
session_start();
include("functions/db_connect.php");
include("functions/util.php");


//CHECK IF THE USERNAME IS AVAILABLE
if(isset($_POST['username'])){
	$user = $_POST['username'];
	$message = "";
	$sql = "SELECT username FROM users WHERE username = '$user'";
	$query = mysqli_query($connection, $sql);
	$num_row = mysqli_num_rows($query);

	if($num_row > 0){
		$message = "Username taken";	
	}
	else{
		$message = "Username Available";	
	}
	mysqli_close($connection);

	echo $message;
}

//CHECK IF THE EMAIL IS AVAILABLE
if(isset($_POST['email'])){
	$email = $_POST['email'];
	$message = "";
	$sql = "SELECT email FROM users WHERE email = '$email'";
	$query = mysqli_query($connection, $sql);
	$num_row = mysqli_num_rows($query);

	if($num_row > 0){
		$message = "Email taken";	
	}
	else{
		$message = "Email Available";	
	}
	mysqli_close($connection);

	echo $message;
}

//CHECK IF THE OLD PASSWORD IS CORRECT
if(isset($_POST['oldPass'])){
	$user = $_SESSION['username'];
	$oldP = encript($_POST['oldPass']);
	$message = "";
	$sql = "SELECT password FROM users WHERE username = '$user' AND password = '$oldP'";
	$query = mysqli_query($connection, $sql);
	$num_row = mysqli_num_rows($query);

	if($num_row > 0){
		$message = "Correct";	
	}
	else{
		$message = "Incorrect";	
	}
	mysqli_close($connection);

	echo $message;
}




//INSERT AND DISPLAY THE COMMENTS
if(isset($_POST['article_comment'])){
	$msg = "";
	$user = $_SESSION['username'];
	$id = $_POST['id'];
	$date = date("d/m/Y");
	$comment = htmlentities(mysql_real_escape_string($_POST['article_comment']));
	if($comment != ""){
		$sql = "INSERT INTO article_comments VALUES('', '$date', '$user','$id' , '$comment' )";
		$query = mysqli_query($connection,$sql);
		//SHOW THE COMMENTS
		$sql = "SELECT * FROM article_comments WHERE article_comment = '$id' ORDER BY date_comment DESC";
		$query = mysqli_query($connection, $sql);
		$num_rows = mysqli_num_rows($query);
		if($num_rows > 0){
			while($row = mysqli_fetch_assoc($query)){
				$date = $row['date_comment'];
				$username = $row['user_comment'];
				$comment = $row['comment'];	
				$msg .= '<table><tr><td>';
				if($user != $username){
					$msg.= $username. ""; 
				}
				else
				{
					$msg .= "<span style='color:#AEDA18'>".$user. "</span>"; 
				}
				$msg .= '</td><td>'.$date.'</td><td>'.$comment.'</td></tr></table>';
			}//END WHILE LOOP
			
		}//END IF LOOP
					
	} //END COMMENT IF
	echo $msg;	
}


//DISPLAY THE COMMENTS
if(isset($_POST['id_article'])){
	$id = $_POST['id_article'];
	$msg = "";
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM article_comments WHERE article_comment = '$id' ORDER BY date_comment DESC";
	$query = mysqli_query($connection, $sql);
	$num_rows = mysqli_num_rows($query);
		if($num_rows > 0){
			while($row = mysqli_fetch_assoc($query)){
				$date = $row['date_comment'];
				$user = $row['user_comment'];
				$comment = $row['comment'];	
				$msg .= '<table><tr><td>';
							
				if($user != $username){
					$msg.= $user. ""; 
				}
				else{
					$msg .= "<span style='color:#AEDA18'>".$user. "</span>"; 
				}
				$msg .= '</td><td>'.$date.'</td><td>'.$comment.'</td></tr></table>';
				
            }
			
		}
		else{
			$msg = "No comment yet for this article!";	
			
		}
	echo $msg;
}

?>