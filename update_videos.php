<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>
<?php
$username = $_SESSION['username'];

?>

<div class="main_wrapper">
	<div id="menu_user_update">
    	<h3>Update Videos</h3>
        <?php include("includes/menu_user.php"); ?>
      
    </div>
    <div id="edit_videos_list">
    	
        <?php 
			$sql = "SELECT * FROM videos WHERE user_video = '$username'";
			$query = mysqli_query($connection, $sql);
			$num_rows = mysqli_num_rows($query);
			if($num_rows > 0){
				?>
                <table id='list_to_update'><tr><td>Title</td><td>Description</td><td>Link Video</td><td>Posted on</td></tr>
                <?php
				while($row = mysqli_fetch_assoc($query)){
					$id_video = $row['id_video'];
                    $date_posted = $row['date_posted'];
                    $title_video = $row['title_video'];
                    $thumbnail = $row['thumbnail'];
					$description = $row['desc_video'];
					$link_video = $row['link_video'];	
				?>
                <tr>
					<td><?php echo $title_video. "     ";?> </td>
                    <td><?php echo $description; ?> </td>
                    <td><?php echo $link_video; ?></td>
                    <td><?php echo $date_posted; ?></td>
                    <td>
                    	<form method="post" action="update_video_page.php">
                    		<button type="submit" id="edit_record_button">Edit</button>
                            <input type="hidden" name="id_video" value="<?php echo $id_video; ?>"/>
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
				echo "You haven't got videos to edit!";	
				
			}
		
		?>
        
        
    </div>    
    

</div><!--End wrapper-->


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>