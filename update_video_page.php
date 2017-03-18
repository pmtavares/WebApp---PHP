<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>

<?php
$username = $_SESSION['username'];
$id_video = @$_POST['id_video'];

##Query to get the registers to update the video
if(isset($_POST['id_video'])){
  $sql = "SELECT * FROM videos WHERE id_video = '$id_video'";
  $query = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($query);
  if($num_rows == 1){
	  while($row = mysqli_fetch_assoc($query)){
		  $id_video = $row['id_video'];
		  $date_posted = $row['date_posted'];
		  $title_video = $row['title_video'];
		  $link_video = $row['link_video'];
		  $description = $row['desc_video'];
		  $category = $row['cat_video'];	
	  }
	  mysqli_free_result($query);
  }
  else{
	  echo "Could not retrieve the information about the video";	
	  
  }
}
else{
	header("Location: index.php");	
	
}

?>

<div class="main_wrapper">
	<div id="menu_user_update">
    	<h3>Update Video</h3>
        <?php include("includes/menu_user.php"); ?>
    	
   </div>
    <div id="form_edit">
    	<form method="post" action="update_ex.php">
    		<p>
                <input type="hidden" name="id_video" value="<?php echo $id_video; ?>" />
                <label for="title_video">Title Video:</label> 
                <input type="text" id ="title_video" name="title_video" value= "<?php echo $title_video; ?>"/> <br/>
                <label for="description_video">Description:</label> 
                <input type="text" name="description_video" id="description_video"value="<?php echo $description; ?>"  /><br/>
                <label for="cat_article">Category</label>
            	<select id = "cat_article"  name="cat_article" class="input_resgister">
           		<?php
				$sql = "SELECT name_cat FROM categories";
  				$query = mysqli_query($connection, $sql);
  				$num_rows = mysqli_num_rows($query);
  				if($num_rows > 0){
	 				while($row = mysqli_fetch_assoc($query)){
		  				$name_cat = $row['name_cat'];
					?>
				<option <?php if($name_cat == $category){ echo "selected='selected'"; }?> 
                value="<?php echo $name_cat; ?>"><?php echo $name_cat; ?></option>
				<?php
	  				} //end while
	  				mysqli_free_result($query);
  				}
  				else{
	  				echo "Could not retrieve the information about the categories";	
	  			}
				
				?>
            	</select></br>
                <label for="link_video">Link Video:</label>
                <textarea id ="link_video" name="link_video" class="input_resgister" rows="15" cols="150"><?php echo $link_video; ?></textarea><br/>
             	</p>
              <p><br/>
                <input type="submit" value="Save" class="button_edit" name="update_video_record" /> 
                <a href="update_articles.php">Back</a>
              </p>
      
    	</form>
   
	</div>
</div><!--End wrapper-->


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>