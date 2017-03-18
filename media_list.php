<?php
require_once("includes/site_header.php");

?>

<div class="main_wrapper">
	<div class="videos_list">
    	<h2>Populars Videos</h2>
       		
            <?php 
			
            	$sql = "SELECT * FROM videos LIMIT 8";
				$query = mysqli_query($connection,$sql);
				if($query){
					while($row = mysqli_fetch_assoc($query)){
						$title_video = $row['title_video'];
						$desc_video = $row['desc_video'];
						$thumbnail = $row['thumbnail'];
		
			?>
            	<div class="video_media">
            	<a href="https://www.youtube.com/watch?v=vJFo3trMuD8" target="_blank"><img src="<?php echo $thumbnail; ?>" alt="" /></a>
            	<h3><?php echo $title_video; ?></h3>
            	<p><?php echo $desc_video; ?></p>
                </div>
            <?php
					}//end while
					mysqli_free_result($query);
					
				}//end if
				else{
					//####### have to create the class #######
					echo "<div class='class_error'>Sorry, could not retrieve information about the videos!</div>";
					
				}
			
			?>
      
    
    </div>	
    <div class="videos_list">
    	<h2>Latest Videos</h2>
        <?php 
			
            	$sql = "SELECT * FROM videos ORDER BY date_posted DESC LIMIT 4";
				$query = mysqli_query($connection,$sql);
				if($query){
					while($row = mysqli_fetch_assoc($query)){
						$title_video = $row['title_video'];
						$desc_video = $row['desc_video'];
						$thumbnail = $row['thumbnail'];
		
		?>
            
        	<div class="video_media">
        		<a href="https://www.youtube.com/watch?v=YQX7JYQjDOQ" target="_blank"><img src="<?php echo $thumbnail; ?>" alt=""/></a>
        		<h3><?php echo $title_video; ?></h3>
           		<p><?php echo $desc_video; ?></p>
       	 	</div>
        <?php
					}//end while
					mysqli_free_result($query);
				}//end if
				else{
					//####### have to create the class #######
					echo "<div class='class_error'>Sorry, could not retrieve information about the videos!</div>";
					
				}
				
		?>
       </div>   

</div><!--End div main_wrapper--> 
  


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>