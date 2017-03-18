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
    <div class="article_list_search">
    	<h2>Search results for your research...</h2>
		<?php
			if(isset($_GET['search_article'])){
				$word_search = mysql_real_escape_string(sanitize($_GET['search_article']));//OR text_article LIKE '%$word_search%'
											
				if($word_search != ""){
					//IF THE WORD TO SEARCH IS NOT EMPTY
					$sql = "SELECT * FROM articles WHERE NOT (status_article='waiting' OR status_article ='blocked') AND (title_article LIKE '%$word_search%' OR text_article LIKE '%$word_search%')  ORDER BY views_article DESC, date_posted DESC";
					$query = mysqli_query($connection,$sql);
					$num_rows = mysqli_num_rows($query);
					
														
					if($num_rows > 20){ //IF THERE IS MORE THAN 20 RECORDS, DO THE CODE BELOW WITH THE PAGES NUMBER FUNCTION
						articlePages($connection, $word_search,'id_article', 'articles');
						$sql = "SELECT * FROM articles WHERE NOT (status_article='waiting' OR status_article ='blocked') AND (title_article LIKE '%$word_search%' OR text_article LIKE '%$word_search%') ORDER BY date_posted $limit";
						$query = mysqli_query($connection,$sql);
						echo "<table class='search_table'><tr><td>Date Posted</td><td>Title Article</td><td>Text Article</td><td>User Posted</td></tr>";
						while($row = mysqli_fetch_assoc($query)){
							$id = $row['id_article'];
                    		$date_posted = $row['date_posted'];
                    		$title_article = $row['title_article'];
                    		$text_article = $row['text_article'];
							$user_posted = $row['user_posted'];
					?>	
						<tr>
                        	<td><?php echo $date_posted; ?></td>
                            <td><a href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id; ?>"><?php echo $title_article; ?></a></td>
                            <td><a href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id; ?>"><?php echo substr($text_article,0,100); ?>
                           		</a>
                            </td>
                            <td><?php echo $user_posted; ?></td>
                        </tr>
                        
					<?php	
						}//End While
					echo "</table>";
					echo "<div id='pagesCntrol'>".$paginationControl."</div>";
					mysqli_free_result($query);
					
					}//End if
					else if($num_rows >0){ //if the number of records are less than 20, no need to show the pages numbers
						echo "<table class='search_table'><tr><td>Date Posted</td><td>Title Article</td><td>Text Article</td><td>User Posted</td></tr>";
						while($row = mysqli_fetch_assoc($query)){
							$id = $row['id_article'];
                    		$date_posted = $row['date_posted'];
                    		$title_article = $row['title_article'];
                    		$text_article = $row['text_article'];
							$user_posted = $row['user_posted'];
					?>	
						<tr>
                        	<td><?php echo $date_posted; ?></td>
                            <td><a href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id; ?>"><?php echo $title_article; ?></a></td>
                            <td><a href="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id; ?>"><?php echo substr($text_article,0,100); ?>
                           		</a>
                            </td>
                            <td><?php echo $user_posted; ?></td>
                        </tr>
                        
					<?php	
						}//End While
					echo "</table>";
					mysqli_free_result($query);
										
					}
					else
					{
						echo "<div class='NotFoundMsg'>Opps! No articles were found. Try another word to search!</div>";	
					}
				} //End second if
				else
				{
					echo "<div class='NotFoundMsg'>Opps! No articles were found. Try another word to search!</div>";
				}
				mysqli_close($connection);
			}//End First If
			
			else{
				
				header("Location: articles.php");	
			}
		?>
    	<br/>
        <a href="articles.php">Go back</a>
    </div>	
  

</div><!--End div main_wrapper--> 

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>
