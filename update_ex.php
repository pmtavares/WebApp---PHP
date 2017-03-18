<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>


<?php

$username = $_SESSION['username'];
$id_article = @$_POST['id_article'];

$update_article = @$_POST['update_article_record'];
$update_video = @$_POST['update_video_record'];
$update_profile = @$_POST['update_profile_record'];
$update_password = @$_POST['update_password_record'];


##HERE IS THE CODE TO UPDATE THE ARTICLES
if(isset($update_article) && isset($username)){
	if($_POST['title_article'] != "" || $_POST['description_article'] != "" ){
		$id_article = $_POST['id_article'];	
		$title_article = sanitize($_POST['title_article']);
		$description = sanitize($_POST['description_article']);
		$text_article = sanitize($_POST['text_article']);
		$category = sanitize($_POST['cat_article']);
				
		#UPDATE#
		$sql = "UPDATE articles SET title_article = '$title_article', text_article = '$text_article', description_article = '$description', cat_article = '$category' WHERE id_article = '$id_article' ";
		$result = mysqli_query($connection, $sql);
		##Check if the record was updated
		if($result){
		?>
			<div class="main_wrapper">
            	<script language="javascript">
					alert('Record was updated!');
					window.location="update_articles.php";
				</script>
            </div>
		<?php		
		}
		else{
			
		?>
        	<div class="main_wrapper">
            	<div class="updated_message">"Sorry, could not update the record! Try again Later. Go <a href="update_articles.php">Back</a></div>
            </div>
        <?php
			
			
		}
		
	} //End if
	else
	{
		header("errormsg.php?message=Could_not_validade_fields");
	}
}//End If isset


##HERE IS THE CODE TO UPDATE THE VIDEOS
if(isset($update_video) && isset($username)){
	if($_POST['title_video'] != "" || $_POST['description_video'] != "" ){
		$id_video = $_POST['id_video'];	
		$title_video = sanitize($_POST['title_video']);
		$description = sanitize($_POST['description_video']);
		$link_video = sanitize($_POST['link_video']);
		$category = sanitize($_POST['cat_article']);
		
		#UPDATE#
		$sql = "UPDATE videos SET title_video = '$title_video', link_video = '$link_video', desc_video = '$description', cat_video = '$category' WHERE id_video = '$id_video' ";
		$result = mysqli_query($connection, $sql);
		##Check if the record was updated
		if($result){
		?>
			<div class="main_wrapper">
            	<script language="javascript">
					alert('Record was updated!');
					window.location="update_videos.php";
				</script>
            </div>
		<?php		
		}
		else{
			
		?>
        	<div class="main_wrapper">
            	<div class="updated_message">"Sorry, could not update the record! Try again Later. Go <a href="update_videos.php">Back</a></div>
            </div>
        <?php
			
			
		}
		
	} //End if
	else
	{
		header("errormsg.php?message=Could_not_validade_fields");	
	}
}//End If isset

##HERE IS THE CODE TO UPDATE THE PROFILE
if(isset($update_profile) && isset($username)){
	if($_POST['user_name'] != "" || $_POST['user_surname'] != "" ){
		$id_user = $_POST['id_user'];	
		$name = sanitize($_POST['user_name']);
		$surname = sanitize($_POST['user_surname']);
		$ocupation = sanitize($_POST['user_ocupation']);
		$email = sanitize($_POST['user_email']);
		$user_photo = $_POST['user_photo'];
		
		#CHECK THE LENGHT OF SOME FIELDS
		if(strlen($name) > 30 || strlen($email) > 50){
			echo "Sorry, check the lenght of the fields!";	
		}
		else{
			#CODE TO UPLOAD THE IMAGE OF THE ARTICLE
			if($user_photo == ""){
				$user_photo = 'images/users/default.jpg';
			}
			if(($_FILES['profile_pic']['type'] == 'image/jpeg') || ($_FILES['profile_pic']['type'] == 'image/jpg')){
			  $file_size = 1097152;
			  if($_FILES['profile_pic']['size'] > $file_size || ($_FILES["profile_pic"]["size"] == 0)){
				 $msg_error = "File is too big. File must be less than 1MB";
				
			  }
			  else{
			  $chars = "abcdeghijlkmnopqrstuvxzABCDEFGHIJKLMNOPQRSTUVXZ1234567890";
			  $random_directory = substr(str_shuffle($chars), 0,15);
			  #CHECK IF FILE ALREADY EXISTS
			  if(file_exists("images/users/".$random_directory."".$_FILES['profile_pic']['name'])){
				  $msg_error = "Photo already exists!";
			  }
			  else{
				  if($user_photo != "images/users/default.jpg"){
					 @unlink($user_photo);// Remove the old photo profile
				  }
				  move_uploaded_file($_FILES['profile_pic']['tmp_name'],"images/users/".$random_directory."".$_FILES['profile_pic']['name'] );	
				  $image_name = $_FILES['profile_pic']['name'];
				  $user_photo = "images/users/".$random_directory.$image_name;
				  
			  }
			  }//END ELSE FILE SIZE
			} //end if
			#UPDATE#
			$sql = "UPDATE users SET name = '$name', surname = '$surname', ocupation = '$ocupation', email = '$email', user_photo = '$user_photo' WHERE id_user = '$id_user' ";
			$result = mysqli_query($connection, $sql);
			##Check if the record was updated
			if($result && $msg_error == ""){
				$_SESSION['user_pic'] = $user_photo;
			?>
			<div class="main_wrapper">
            	<script language="javascript">
					alert('Record was updated!');
					window.location="edit_profile.php";
				</script>
            </div>
			<?php		
			}
			else{
			
			?>
        	<div class="main_wrapper">
            	<div class="updated_message">Sorry, could not update the record! <br/>
					<?php echo $msg_error."<br/>"; ?>
				Try again Later. Go <a href="update_articles.php">Back</a></div>
            </div>
        	<?php
			} // End else
				
		}//End else
	} //End if
	else
	{
		header("errormsg.php?message=Could_not_validade_fields");	
		
	}
}//End If isset

##HERE IS THE CODE TO UPDATE THE PASSWORD
if(isset($update_password)){
	if($_POST['old_password'] != "" || $_POST['new_password'] != "" || $_POST['repeat_password'] ){
		$id_user = $_POST['id_user'];	
		$oldPass = sanitize($_POST['old_password']);
		$newPass = preg_replace('#[^0-9a-z]#i', '', sanitize($_POST['new_password']));
		$repPass = sanitize($_POST['repeat_password']);
		$crypOldPass = encript($oldPass);
		$crypNewPass = encript($newPass);
		
		if($newPass != $repPass){
		?>
        <div class="main_wrapper">
        	<div class="updated_message">Sorry, new and repeat password must match! Go <a href="edit_profile.php">Back</a></div>
        </div>
        <?php	
			
		}
		else if(strlen($newPass) < 5 || strlen($newPass) > 50){
		?>
		 <div class="main_wrapper">
        	<div class="updated_message">Check the lenght of your new password. Must be more than five and
            less than 50! Go <a href="edit_profile.php">Back</a></div>
        </div>
		<?php	
		}
		else
		{
			//CHECK IF THE OLD PASSWORD MATCH
			$sql = "SELECT password FROM users WHERE id_user='$id_user' AND password = '$crypOldPass'";
			$query = mysqli_query($connection, $sql);
			$num_rows = mysqli_num_rows($query);
			//IF THERE THE OLD PASSWORD DOES NOT MATCH, GO BACK
			if($num_rows < 1){
			?>
			<div class="main_wrapper">
        		<div class="updated_message">Old password does not match! Try again. Go <a href="edit_profile.php">Back</a></div>
        	</div>
            <?php		
			}
			else if($num_rows == 1)
			{
				//UPDATE THE PASSWORD
				$sql = "UPDATE users SET password='$crypNewPass' WHERE id_user='$id_user' and password='$crypOldPass'";
				$query = mysqli_query($connection, $sql);
				
				if($query){
				?>
				<div class="main_wrapper">
        		<div class="updated_message">Password updated successfully. Go <a href="edit_profile.php"> Back</a></div>
        		</div>
                <?php	
				}
				else
				{
				?>	
				<div class="main_wrapper">
        		<div class="updated_message">Could not update. Try again later. Go <a href="edit_profile.php"> Back</a></div>
        		</div>
                <?php	
				}
			}
			else
			{
			?>	
			<div class="main_wrapper">
        	<div class="updated_message">Something went wrong. Try again later. Go <a href="edit_profile.php">Back</a></div>
        	</div>
            <?php		
			}
			
			
		}//end else
		
	}//END IF
	else
	{
		header("errormsg.php?message=Could_not_validade_fields");	
		
	}
} //End If Isset

?>
<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>