<?php
require_once("includes/site_header.php");
include("libs/list_videos.php");

$id_video = $_GET['id_video'];
$success = @$_GET['success'];
$error = @$_GET['error'];

if(isset($id_video) || $id_video == ""){
	if($list_videos != 0){
		foreach($list_videos as $key => $value){
			$id = $value['id_video'];
			$title = $value['title_video'];
			$date = $value['date_posted'];
			$category = $value['cat_video'];
			$user = $value['user_video'];
			$views = $value['views_video'];
			$status = $value['status_video'];
		}
	
?>

e
<div id="main_div">
	
    <?php 
		if(isset($error) && $error == "Could not update"){
			echo '<div class="alert-danger" role="alert">'.$error.'</div>';
		}
		else if(isset($success) && $success == "Successfuly Updated"){
			echo '<div class="alert-info">'.$success.'</div>';
		}
		
	?>
    <div class="delete_article_video_form">
    <h3>Are you sure you want to delete this Video?</h3>	
	 <form method="post" action="delete_video_ex.php" >
    		<input type="hidden" name="id_video" value="<?php echo $id;?>">
            <label for="title_video">Title</label>
            <input type="text" name="title_video" id="title_video" class="text_input" value="<?php echo $title; ?>" disabled/><br/>
            <label for="date_posted">Data Posted</label>
            <input type="text" name="date_posted" id="date_posted" class="text_input" value="<?php echo $date; ?>" disabled/><br/>
            <label for="user">Username</label>
            <input type="text" name="user" id="user"  class="text_input" value="<?php echo $user; ?>" disabled/><br/>
            <label for="cat_video">Category</label>
            <select id = "cat_video"  name="cat_video" disabled class="text_input">
            <?php
			if($list_categories != 0){
				foreach($list_categories as $key =>$value){
					$categoryList = $value['name_cat']; 
				?>
                <option <?php if($categoryList == $category){ echo "selected='selected'"; }?> 
                	value="<?php echo $categoryList; ?>">
					<?php echo $categoryList; ?>
                </option>
                <?php
				} //end for each
			} //end if
					
			?>
            </select></br>
            
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="text_input" value="<?php echo $status; ?>" disabled/>
    		<label for="views">Views</label>
            <input type="text" name="views" id="views" class="text_input" value="<?php echo $views; ?>" disabled/><br/>
            <input type="submit" value = "Confirm" name="delete_video" id="delete_video"/>
            <a href="videos_list.php">Cancel</a>
    
    	</form>
        
	</div>


</div>
<?php
	}
	else{
		header("Location: videos_list.php");
	}
}
else
{
	header("Location: videos_list.php");
}

?>


<?php
require_once("includes/site_footer.php");
?>