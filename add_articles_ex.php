<?php require_once("includes/site_header.php"); ?>

<?php
$msg_error = ""; // Message to display when validading the fields
$username = $_SESSION['username'];
if(!isset($username)){
	header("Location: index.php");	
}

#CODE TO EXECUTE AND ADD THE ARTICLES
if(isset($_POST['send_article'])){
	//GET THE FIELDS FROM THE ARTICLE FORM AND SANITIZE ALL
	if($_POST['title_article'] != "" || $_POST['description_article'] != "" || $_POST['text_article'] != ""){
		$title_article = mysql_real_escape_string(sanitize($_POST['title_article']));	
		$description_article = mysql_real_escape_string(sanitize($_POST['title_article']));
		$text_article = mysql_real_escape_string(sanitize($_POST['text_article']));
		$cat_article = $_POST['cat_article'];
		$date_created = date("Y/m/d");
		
		//CHECK THE LENGHT OF SOME FIELDS
		if(strlen($title_article) > 60 || strlen($description_article)> 120){
			$msg_error =  "Please check the lenghts of the fields: Title and Description.Click <a href='add_articles.php'>here </a>to go back.";
			
		}
		else{
				//CHECK IF THE ARTICLE ALREADY EXISTS
			  $sql = "SELECT id_article, title_article FROM articles where title_article='$title_article'";
			  $query = mysqli_query($connection, $sql);
			  $num_rows = mysqli_num_rows($query);
			  if($num_rows > 0){
				  $msg_error =  "Article ".$title_article." already exists. Click <a href='add_articles.php'>here </a>to go back.";	
			  }
			  else{
				  
				  #CODE TO UPLOAD THE IMAGE OF THE ARTICLE
				  $article_pic = 'images/articles/default_article.jpg';
				  
				  if(($_FILES['article_pic']['type'] == 'image/jpeg')	|| ($_FILES['article_pic']['type'] == 'image/jpg')){
					$chars = "abcdeghijlkmnopqrstuvxzABCDEFGHIJKLMNOPQRSTUVXZ1234567890";
					$random_directory = substr(str_shuffle($chars), 0,15);
					#CHECK IF FILE ALREADY EXISTS
					if(file_exists("images/articles/".$random_directory."".$_FILES['article_pic']['name'])){
						$msg_error = "Image already exists!";
					}
					else{
						move_uploaded_file($_FILES['article_pic']['tmp_name'],"images/articles/".$random_directory."".$_FILES['article_pic']['name'] );	
						$image_name = $_FILES['article_pic']['name'];
						$article_pic = "images/articles/".$random_directory.$image_name;
												
					}
					
				  }
				  //ADD THE ARTICLES
				  $sql = "INSERT INTO articles VALUES('','$title_article', '$description_article', '$date_created','$text_article','$article_pic','$cat_article','$username','', '0', '0', 'waiting')";
				  $query = mysqli_query($connection, $sql);
				  $msg_error = "";
				  
				  //IN CASE THE USER UPLOAD A TOO BIG PHOTO, RESIZE IT.
				  $image_resized = $article_pic;
				  $width_max = 200;
				  $heigth_max = 300;
				  $exploded = explode(".", $article_pic);
				  $fileExt = end($exploded);
				  img_resize($article_pic, $image_resized, $width_max, $heigth_max, $fileExt);
			  }
			
		}//END ELSE
		
	}// END IF
	else{
		$msg_error = "You can't leave fields empty, go <a href='add_articles.php'>BACK</a> and try again";
		
		
	}
}else{
	header("Location: add_articles.php");	
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
	<p>Title: <?php echo $title_article; ?></p>
	<p>Description: <?php echo $description_article; ?></p>
	<p>Category: <?php echo $cat_article; ?></p>
	
    <h4>Thank you <?php echo $username; ?></h4>
</div>

<a href="add_articles.php">Back</a>
<?php } //END ELSE ?>

</div>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>