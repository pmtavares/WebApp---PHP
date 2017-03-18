<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>


<?php
$username = $_SESSION['username'];
$id_article = @$_POST['id_article'];

##Query to get the registers to update the article
if(isset($_POST['id_article'])){
  $sql = "SELECT * FROM articles WHERE id_article = '$id_article'";
  $query = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($query);
  if($num_rows == 1){
	  while($row = mysqli_fetch_assoc($query)){
		  $id_article = $row['id_article'];
		  $date_posted = $row['date_posted'];
		  $title_article = $row['title_article'];
		  $text_article = $row['text_article'];
		  $description = $row['description_article'];	
		  $category = $row['cat_article'];
	  }
	  mysqli_free_result($query);
  }
  else{
	  echo "Could not retrieve the information about the article";	
	  
  }
}
else{
	header("Location: index.php");	
	
}

?>

<div class="main_wrapper">
	<div id="menu_user_update">
    	<h3>Update Article</h3>
        <?php include("includes/menu_user.php"); ?>
    </div>
    
    <div id="form_edit">
    	<form method="post" action="update_ex.php">
    		<p>
                <input type="hidden" name="id_article" value="<?php echo $id_article; ?>" />
                <label for="title_article">Title Article:</label> 
                <input type="text" id ="title_article" name="title_article" value= "<?php echo $title_article; ?>"/> <br/>
                <label for="description_article">Description:</label> 
                <input type="text" name="description_article" id="description_article"value="<?php echo $description; ?>"  /><br/>
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
                <label for="text_article">Text:</label>
                <textarea id ="text_article" name="text_article" class="input_resgister" rows="15" cols="150"><?php echo $text_article; ?></textarea><br/>
             	</p>
              	<p><br/>
                <input type="submit" value="Save" class="button_edit" name="update_article_record" /> 
                <a href="update_articles.php">Back</a>
              </p>
       
    	</form>
   
	</div>
</div><!--End wrapper-->


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>