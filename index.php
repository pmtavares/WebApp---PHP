<?php require_once("includes/site_header.php"); ?>

<body>  
  <div class="main_wrapper">
<?php include("includes/slide_index.php"); ?>
    
    <div id="three_subjects">
    	  <?php
				$sql = "SELECT * FROM articles WHERE status_article = 'front' AND user_posted='pedro' ORDER BY date_posted DESC LIMIT 3";	
				$query = mysqli_query($connection,$sql);
			  	$num_rows = mysqli_num_rows($query);
				if($num_rows != 0){
				  while($row = mysqli_fetch_assoc($query)){
					  $id = $row['id_article'];
					  $title_article = $row['title_article'];
					  $description_article = $row['description_article'];
					  $text_article = $row['text_article'];
		?>
         <div class="subject_index">
        		<h2><?php echo $title_article; ?></h2>
            	<h3><?php echo $description_article; ?></h3>
            	<a href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id;?>" class="link_subjects">READ MORE</a>
            	<p class="detail_article" id="subject1"><?php echo $text_article; ?>
            	</p>
        </div>
        <?php
				  }//End While
				  mysqli_free_result($query);
				}//End If
				else{
					echo "The video could not be loaded. It might not be some connection problem";
					mysqli_close($connection);
					exit();		
				}
        ?>
    </div> <!--End div three subjects-->
    
    <div id="video_news">
    	<div id="latest_video">
        	<h3>LATEST VIDEO</h3>
            <?php
				 $sql = "SELECT link_video FROM videos WHERE cat_video = 'front' AND user_video='pedro' ORDER BY date_posted LIMIT 1";
				 $query = mysqli_query($connection, $sql);
				 $result = mysqli_fetch_assoc($query);
				 if($result){
					$link_video = substr($result['link_video'],32);
					mysqli_free_result($query);
				}
				else{
					echo "The video could not be loaded. It might not be some connection problem";
					mysqli_close($connection);
					exit();
				}
			?>
        	<iframe width="550" height="450" src="http://youtube.com/embed/<?php echo $link_video; ?>?autoplay=0&amp;controls=0&amp;showinfo=0" 
            	 allowfullscreen>
			</iframe>
        </div>
        <!-- Display the articles news -->
        <?php
        	$sql = "SELECT * FROM articles WHERE status_article = 'news' ORDER BY date_posted LIMIT 2 ";
			$query = mysqli_query($connection, $sql);
			$num_rows = mysqli_num_rows($query);
			
			if($num_rows != 0){
				while($row = mysqli_fetch_assoc($query)){
					$id = $row['id_article'];
					$title_article = $row['title_article'];
					$image_article = $row['image_article'];
					$description = $row['description_article'];
			
		?>
        	<div class="news_side">
        		<img src="<?php echo $image_article; ?>" alt=""/>
        		<h3><?php echo $title_article; ?></h3>
            	<p>
            	<?php echo $description; ?>
           	 	</p>
           	 	<a id='see_more' href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id;?>">Read More</a>
        	</div>
        
        <?php	
				} //End While
				mysqli_free_result($query);
			} //End second If
			else{
				header("Location: errormsg.php?message=content_not_fount");
        		mysqli_close($connection);
					
			
			}//END first IF
	
		?>
  		<!-- END Display the articles news -->
    </div><!--End div video_news-->
    
  </div><!--End div main_wrapper-->
</body>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>
