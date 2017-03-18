<?php
require_once("includes/site_header.php");
include_once("functions/util.php");
$username = @$_SESSION['username'];
$ida = $_GET['id'];
$status_comment = "";

?>
<head>
<script src="js/ajax.js"></script>
</head>

<body  onload="show_comments();">  
<div class="main_wrapper">
<?php 
	if(isset($_GET['article']) && isset($_GET['id'])){
		$id = $_GET['id'];
		$title_article = $_GET['article'];	
		$sql = "SELECT * FROM articles WHERE title_article='$title_article' AND id_article='$id' LIMIT 1";
		$query = mysqli_query($connection,$sql);
		$num_rows = mysqli_num_rows($query);
		if($num_rows == 1){
				$row = mysqli_fetch_assoc($query);
				$id = $row['id_article'];
				$date_posted = $row['date_posted'];
				$title_article = $row['title_article'];
				$text_article = $row['text_article'];
				$image_article = $row['image_article'];
				$posted_by = $row['user_posted'];
				$views = $row['views_article'];
				//The code to record the views of the article
				articleViews($id, $views, $connection);
				
				
		
?>
		<div id="article_ind">
    		<div id="header">
            	<div class="index_date">Created on: <?php echo $date_posted; ?></div>
        		<div class="index_title"><?php echo $title_article; ?> </div>
            	<div class="posted_by">Posted by: <?php echo $posted_by;?> </div>
            	<div class="view_number">Views: <?php echo $views; ?></div> 
                <div class="likes_number">
				<?php $likes = articleLike($connection, $username, $_GET['article']); ?>
                 <?php echo $likes." "; ?>
             	</div> 
        	</div>
        	<div id="content_article">
        		<img src="<?php echo $image_article; ?>" alt=""/>
        		<p class="ind_article">
        		<?php echo $text_article; ?>
        		</p>
        			
        	</div>
            
            <div class="comments_article_div">
            	<div id="header_comments">
                	<h3>Comments</h3>
                    <div id="status_comment"><?php echo $status_comment; ?></div>
                </div>
                 
                <div id="comment_field">
               	<?php if(isset($username)){
				?>
    				<form method="POST" onSubmit="return false;">
                	<textarea name ="text_comment" id="text_comment" placeholder="Comment here..." maxlength="400"></textarea>
                    <input type="hidden" name="id_article" id="id_article" value="<?php echo $ida; ?>"/>
                    <input type="submit" name="send_comment" id="send_comment" value="Comment" onClick="add_comments();"/>
                    </form>
                    
                    
                <?php
					}
				else{
				?>
					<form>
                	<textarea id="text_comment" placeholder="You have to login to make a comment..." maxlength="400" disabled></textarea>
                    <input type="submit" name="send_comment" id="send_comment" value="Disable" disabled/>
                    </form>
                <?php
				}
				
				?>    
                </div>
                <div id="users_comments">
                	<div id="comment_user">
                    	
                    </div>
                </div>
               
           </div>
            <a href="articles.php" class="go_back">Go back</a>			
   		</div>

<?php        
		}
		
		else{
			header("Location: errormsg.php?message=content_not_fount");
        	
			
		 }
	
	} // END ISSET IF
	else{
		header("Location: errormsg.php?message=error");
		
		
	}


?>

</div> <!--End Main wrapper -->
</body>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>