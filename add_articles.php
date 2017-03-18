<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>

<body>
<div class="main_wrapper">
	<div id="menu_user">
		<?php include("includes/cat_menu_user.php"); ?>
	</div>

    <div id="add_video_article">
    	<p id="invalid_field_message2" class="invalid_field_message"></p>
    	 <h4>Add a new article</h4>
         
          <h5>Items marked with * are required.</h5>
          
          <form id="add_article" name ="add_article" action="add_articles_ex.php" method="POST"  enctype="multipart/form-data" >
              <label for="title_article">Title* </label>
              <input type="text" id ="title_article" class="input_resgister" name="title_article"  maxlength="60" /><br/>
              <label for="description_article">Article Description* </label>
              <input type="text" id ="description_article" class="input_resgister" name="description_article"  maxlength="120" /><br/>
              <label for="text_article">Article Text* </label>
              <textarea id ="text_article" name="text_article" class="input_resgister" rows="15" cols="150"></textarea><br/>
              <label for="image_article">Article Image</label>
              <input type="file" name="article_pic" id= "article_pic" class="input_resgister" value="Upload your image" /><br/>
              <label for="cat_article">Article Category*</label>
              <select class="input_resgister" id = "cat_article"  name="cat_article">
			  	<option selected="selected">Select Category</option>
			  <?php 
              	$sql = "SELECT name_cat FROM categories";
				$query = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_assoc($query)){
					$category = $row['name_cat'];	
				
              ?>
              <option><?php echo $category; ?></option>
              <?php
				}
			   ?>
              </select><br/>
                            
              <input type="submit" name="send_article" id="send_article" value="Send" onClick="return ArticleFormValidator()"/><br/>
              <input type="reset" value="Clear" id="reset_article"/><br/><br/><br/>
   		</form>
        <p id="valid_field_message"></p>
          <noscript>
            Oooops! Your JavaScript is turned-off. If you do not turn it on, you might not be able to enjoy everything!
          </noscript>
    		 
    </div>


</div><!--End wrapper-->
</body>
<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>