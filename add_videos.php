<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>

<div class="main_wrapper">
	<div id="menu_user">
    	<?php include("includes/cat_menu_user.php"); ?>
    </div>
	

    <div id="add_video_article">
        <h4>Add a new video</h4>
        	<p id="invalid_field_message2"></p>
          <h5>Items marked with * are required.</h5>
          <form id="add_video" name = "add_video" action="add_videos_ex.php" method="POST" enctype="multipart/form-data"  >
              <label for="title_video">Title* </label>
              <input type="text" id ="title_video" class="input_resgister" name="title_video"  maxlength="60" /><br/>
              <label for="description_video">Video Description* </label>
              <input type="text" id ="description_video" class="input_resgister" name="description_video"  maxlength="120" /><br/>
              <label for="text_video">Video Text* </label>
              <textarea id ="text_video" name="text_video" class="input_resgister" rows="15" cols="150"></textarea><br/>
              <label for="image_video">Video Image</label>
              <input type="file" name="image_video" id= "image_video" class="input_resgister" value="Upload your image" /><br/>
              <label for="cat_video">Video Category*</label>
              <select class="input_resgister" id = "cat_video"  name="cat_video">
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
              <label for="link_video">Link Video</label>
              <input type="text" id = "link_video" class="input_resgister" name="link_video"   maxlength="90"/><br/>              
              <input type="submit" name="send_video" id="send_video" value="Send" onClick="return VideoFormValidator()" /><br/>
              <input type="reset" value="Clear" id="reset_video"/><br/>
                       
          </form>
          <noscript>
            Oooops! Your JavaScript is turned-off. If you do not turn it on, you might not be able to enjoy everything!
          </noscript>
    		 <p id="valid_field_message"></p>
    </div>


</div><!--End wrapper-->

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>