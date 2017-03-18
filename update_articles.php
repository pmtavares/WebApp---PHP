<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>
<?php
$username = $_SESSION['username'];

?>

<div class="main_wrapper">
	<div id="menu_user_update">
    	<h3>Update Articles</h3>
    	<?php include("includes/menu_user.php"); ?>	
         
    </div>
    <div id="edit_articles_list">
    	
        <?php 
			$sql = "SELECT * FROM articles WHERE user_posted = '$username'";
			$query = mysqli_query($connection, $sql);
			$num_rows = mysqli_num_rows($query);
			if($num_rows > 0){
				?>
                <table id='list_to_update'><tr><td>Title</td><td>Description</td><td>Posted on</td></tr>
                <?php
				while($row = mysqli_fetch_assoc($query)){
					$id_article = $row['id_article'];
                    $date_posted = $row['date_posted'];
                    $title_article = $row['title_article'];
                    $text_article = $row['text_article'];
					$description = $row['description_article'];	
				?>
                <tr>
					<td><?php echo $title_article;?> </td>
                    <td><?php echo $description; ?> </td>
                    <td><?php echo $date_posted; ?></td>
                    <td>
                    	<form method="post" action="update_article_page.php">
                    		<button type="submit" id="edit_record_button">Edit</button>
                            <input type="hidden" name="id_article" value="<?php echo $id_article; ?>"/>
                        </form>
                    </td>
				</tr> 
                        
                <?php	
				}
				?>
                </table>
                <?php
				mysqli_free_result($query);
			}
			else{
				echo "You haven't got articles to edit!";	
				
			}
		
		?>
        
        
    </div>    
    

</div><!--End wrapper-->


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>