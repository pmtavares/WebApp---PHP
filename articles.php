<?php
include_once("includes/site_header.php");

?>
<div class="main_wrapper">
	<?php
		if(loggedin()){
			include("includes/menu_user.php");
		}
	
	?>
	<div id="search_field">
    	<form action="search_articles.php" method="GET">
        	<input type="image" src="images/icons/Search-icon.png" alt="Search" Title="Click to search..." />
        	<input type="text" name="search_article" id="search_article" placeholder="Search Article..."/>
            
        </form>
        
    </div>	
    <div class="article_list">
    	<h2>Latest Articles</h2>
		<?php
        //CHECK IF THE CATEGORY IS SET
        if(isset($_GET['category'])){
            $category = mysql_real_escape_string(sanitize($_GET['category']));
            $sql = "SELECT * FROM articles WHERE cat_article='$category' ORDER BY date_posted DESC LIMIT 4";
            $query = mysqli_query($connection,$sql);
        	$num_rows = mysqli_num_rows($query);
			if($num_rows == 0){
				echo "Sorry, no articles in the category ". strtolower($category )."!";
					
			}
			
        }
		
        //IF IS NOT SET, SHOW ALL ARTICLES
        else{
            $sql = "SELECT * FROM articles WHERE status_article ='ready' ORDER BY date_posted DESC LIMIT 4";
			$query = mysqli_query($connection,$sql);
        	$num_rows = mysqli_num_rows($query);	
        }		
        	      
            if($num_rows > 0){
                while($row = mysqli_fetch_assoc($query)){
                    $id = $row['id_article'];
                    $date_posted = $row['date_posted'];
                    $title_article = $row['title_article'];
                    $text_article = $row['text_article'];
                    $image_article = $row['image_article'];
                    
        ?>	
        <div class="articles_list_ind">
            <p class="index_date"><?php echo $date_posted; ?>   ||</p>
            <p class="index_title"><?php echo $title_article; ?> </p>
            <div id="detail_article">
            <img src="<?php echo $image_article; ?>" alt=""/> 
        <?php
            if(strlen($text_article) > 600){
                echo '<p class="about_article">';
                echo substr($text_article,0,600)." ...";
                echo "</p>";
                echo "<a id='see_more' href='article.php?article=".$title_article."&id=".$id."';>
                        See more...	</a>";
            }else{
                echo '<p class="about_article">';
                echo $text_article;
                echo "</p>";
				echo "<a id='see_more' href='article.php?article=".$title_article."&id=".$id."';>
                        See details...	</a>";
            } 
        ?>
    	</div> <!--detail article -->
	</div><!--articles_list_ind -->
	<?php		
				}//End while
					mysqli_free_result($query);
					
			
			} //End query If
	
		
?>
  
</div>
<?php include_once("includes/cat_menu_side.php"); ?>	
</div><!--End div main_wrapper--> 

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>
