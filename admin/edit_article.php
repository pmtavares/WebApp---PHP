<?php
require_once("includes/site_header.php");
include("libs/list_articles.php");

$id_article = $_GET['id_article'];
$success = @$_GET['success'];
$error = @$_GET['error'];

if(isset($id_article) || $id_article != ""){
	if($list_articles != 0){
		foreach($list_articles as $key => $value){
			$id = $value['id_article'];
			$title = $value['title_article'];
			$date = $value['date_posted'];
			$category = $value['cat_article'];
			$user = $value['user_posted'];
			$views = $value['views_article'];
			$status = $value['status_article'];
		}
	
?>

<div id="main_div">
	
    <?php 
		if(isset($error) && $error == "Could not update"){
			echo '<div class="alert-danger" role="alert">'.$error.'</div>';
		}
		else if(isset($success) && $success == "Successfuly Updated"){
			echo '<div class="alert-info">'.$success.'</div>';
		}
		
	?>
    <div id="edit_article_form">
    <h3>Edit Article</h3>	
	 <form method="post" action="edit_art_ex.php" >
    		<input type="hidden" name="id_article" value="<?php echo $id;?>">
            <label for="title_article">Title</label>
            <input type="text" name="title_article" id="title_article" class="text_input" value="<?php echo $title; ?>"/><br/>
            <label for="date_posted">Data Posted</label>
            <input type="text" name="date_posted" id="date_posted" class="text_input" value="<?php echo $date; ?>"/><br/>
            <label for="user">Username</label>
            <input type="text" name="user" id="user"  class="text_input" value="<?php echo $user; ?>"/><br/>
            <label for="cat_article">Category</label>
            <select id = "cat_article"  name="cat_article" class="text_input">
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
            <select id ="status"  name="status" class="text_input">
            <?php
			if($list_status != 0){
				foreach($list_status as $key =>$value){
					$status_list = $value['desc_status']; 
				?>
                <option <?php if($status_list == $status){ echo "selected='selected'"; }?> 
                	value="<?php echo $status_list; ?>">
					<?php echo $status_list; ?>
                </option>
                <?php
				} //end for each
			} //end if
					
			?>
            </select></br>
            <label for="views">Views</label>
            <input type="text" name="views" id="views" class="text_input" value="<?php echo $views; ?>"/><br/>
            <input type="submit" name="edit_article" id="edit_article"/>
            <a href="articles_list.php"> Back</a>
    
    	</form>
        
	</div>


</div>
<?php
	}
	else{
		header("Location: articles_list.php");
	}
}
else
{
	header("Location: articles_list.php");
}

?>


<?php
require_once("includes/site_footer.php");
?>