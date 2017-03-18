<?php require_once("includes/site_header.php"); ?>

<?php
$msg_error = ""; // Message to display when validading the fields
$username = $_SESSION['username'];
if(!isset($username)){
	header("Location: index.php");	
}

#CODE TO EXECUTE AND ADD THE ARTICLES
if(isset($_POST['send_video'])){
	//GET THE FIELDS FROM THE ARTICLE FORM AND SANITIZE ALL
	if($_POST['title_video'] != "" || $_POST['description_video'] != "" || $_POST['text_video'] != ""){
		$title_video = sanitize($_POST['title_video']);	
		$description_video = sanitize($_POST['description_video']);
		$text_video = sanitize($_POST['text_video']);
		$cat_video = $_POST['cat_video'];
		$date_created = date("Y/m/d");
		$link_video = $_POST['link_video'];
		
		//CHECK THE LENGHT OF SOME FIELDS
		if(strlen($title_video) > 60 || strlen($description_video)> 120){
			$msg_error =  "Please check the lenghts of the fields: Title and Description.Click <a href='add_videos.php'>here </a>to go back.";
			
		}
		else{
				//CHECK IF THE ARTICLE ALREADY EXISTS
			  $sql = "SELECT id_video, title_video FROM videos where title_video='$title_video'";
			  $query = mysqli_query($connection, $sql);
			  $num_rows = mysqli_num_rows($query);
			  if($num_rows > 0){
				  $msg_error =  "Video ".$title_video." already exists. Click <a href='add_videos.php'>here </a>to go back.";	
			  }
			  else{
				  
				  #CODE TO UPLOAD THE IMAGE OF THE VIDEO
				  $video_pic = 'images/media/default_image.jpg';
				  
				  if(($_FILES['image_video']['type'] == 'image/jpeg')	|| ($_FILES['image_video']['type'] == 'image/jpg')){
					$chars = "abcdeghijlkmnopqrstuvxzABCDEFGHIJKLMNOPQRSTUVXZ1234567890";
					$random_directory = substr(str_shuffle($chars), 0,15);
					#CHECK IF FILE ALREADY EXISTS
					if(file_exists("images/media/".$random_directory."".$_FILES['image_video']['name'])){
						$msg_error = "Image already exists!";
					}
					else{
						move_uploaded_file($_FILES['image_video']['tmp_name'],"images/media/".$random_directory."".$_FILES['image_video']['name'] );	
						$image_name = $_FILES['image_video']['name'];
						$video_pic = "images/media/".$random_directory.$image_name;
						
					}
					
				  }
				  //ADD THE VIDEO
				  $sql = "INSERT INTO videos VALUES('','$title_video', '$description_video', '$cat_video','$date_created','$username','waiting','0','$video_pic', '$link_video')";
				  $query = mysqli_query($connection, $sql);
				  $msg_error = "";
			  }
			
		}//END ELSE
		
	}// END IF
	else{
		$msg_error = "You can't leave fields empty, go <a href='add_videos.php'>BACK</a> and try again";
		
		
	}
}else{
	header("Location: add_videos.php");	
}


?>

<div class="main_wrapper">

<?php 
	if($msg_error != ""){ ?>
		<div id="validade_registration">
			<h3><?php echo $msg_error; ?></h3>
		</div>
<?php 
	}// END IF 
	else{
?>
<div id="confirmation_registration">
	<h3>The following have been added...</h3>
	<p>Title: <?php echo $title_video; ?></p>
	<p>Description: <?php echo $description_video; ?></p>
	<p>Category: <?php echo $cat_video; ?></p>
	
    <h4>Thank you <?php echo $username; ?></h4>
</div>

<a href="add_videos.php">Back</a>
<?php } //END ELSE ?>

</div>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>