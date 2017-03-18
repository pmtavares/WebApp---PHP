<?php

/*
This Function is to sanitize the input of the user.
This function will use the main php functions used to sanitize.
Here, they will be used all at once
*/
function sanitize($string){
	$strip = strip_tags($string);
	$trim = trim($strip);
	$htmlchar = htmlspecialchars($trim);
	return $htmlchar;

}


//check if the user is loggedin
function loggedin(){
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
		return true;	
	}else{
		return false;	
	}
	
}
//function to encript the password
function encript($password){
	$password_md5 = md5($password);
	$enc_password = crypt($password,$password_md5);
	return $enc_password;
}

//Check if the user  or manager is loggedin
function checkSession(){
	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
		if(!isset($_SESSION['username']) || $_SESSION['username'] == ""){
			header("Location: index.php");
		}
	}
	else{
		return $_SESSION['admin'];	
		
	}
	

}
//Check if the user is logged in more than 30 min, if so, expire the session
function expiredSession(){
	$inactive =3600; // could be any value the admin wants.
	if(isset($_SESSION['created'])){
		if(time() - $_SESSION['created'] > $inactive){
			session_destroy();
			header("Location: errormsg.php?message=session_expired");	
		}
		
	}

}

//This function will increment the views of each article

function articleViews($id, $views,$connection){
	$new_views = $views + 1;
	$sql = "UPDATE articles SET views_article='$new_views' WHERE id_article='$id'";	
	$update_views = mysqli_query($connection, $sql);
}

//FUNCTION TO LIKE THE ARTICLES
function articleLike($connection, $user){
	$id_article = $_GET['id'];
	$title_article =$_GET['article']; 
	//SELECT THE USER ID
	$sql = "SELECT id_user FROM users WHERE username='$user' LIMIT 1";
	$query = mysqli_query($connection, $sql);
	$result = mysqli_fetch_assoc($query);
	$user_id = $result['id_user'];
	
	//Insert the like if the user click on the image
	if(isset($_POST['like_button'])){
		$sql = "INSERT INTO articles_likes VALUES('', '$id_article', '$user_id')";
		$query = mysqli_query($connection, $sql);	
		header("Location: article.php?article=".$title_article."&id=".$id_article."");
	}
	
	//CHECK IF THE USER ALREADY LIKED THE ARTICLE
	if(isset($_SESSION['username'])){
		  $sql = "SELECT * FROM articles_likes WHERE articles_id='$id_article' AND user_id='$user_id' LIMIT 1";
		  $query = mysqli_query($connection, $sql);
		  $num_rows = mysqli_fetch_row($query);
		  if($num_rows[0] > 0){
			  echo "<div class='like_form'>
					  <img src='images/icons/likedButton.png' alt='You already liked this' title='You liked this'/>
				  </div>";	
			  
		  }
		  else{
		  
		  ?>
			  <div class = "like_form">	
			  <form method="post" action="article.php?article=<?php echo $title_article; ?>&id=<?php echo $id_article; ?>">
				  <input type="hidden" name="like_button" />
				  <input type="image" src="images/icons/likeButton.png" alt="Like" Title="Like this article" />
			  </form>
			  </div>
		  <?php		
			
		  }
		  $sql = "SELECT COUNT(*) FROM articles_likes WHERE articles_id='$id_article'";
		  $query = mysqli_query($connection, $sql);
		  $row = mysqli_fetch_row($query);
		  if($row[0] == 0){
			  $message = "Be the first to like this";
		  }
		  else{
			  
			  $message = $row[0]. "  liked this";
		  }
	}
	else{
		$sql = "SELECT COUNT(*) FROM articles_likes WHERE articles_id='$id_article'";
		$query = mysqli_query($connection, $sql);
		$row = mysqli_fetch_row($query);
		if($row[0] == 0){
			$message = "<div class='like_form'>
					  	<img src='images/icons/likedButton.png' alt='Login to like this article' title='Login to like this article'/>
				  		</div>";
			$message .= "  Login to like this";
		}
		else{
			$message = "<div class='like_form'>
					  	<img src='images/icons/likedButton.png' alt='Login to like this article' title='Login to like this article'/>
				  		</div>";  
			$message .= $row[0]. "  liked this";
		}
		
	}
	return $message;
}

//PAGINATION FUNCTION
function articlePages($connection, $word, $id, $table){
	$pn = @$_GET['pn'];
	global $limit, $rows, $last, $pagenum, $textline1,$textline2, $paginationControl ;
	//query to get the total number of rows
	$sql = "SELECT COUNT($id) FROM $table";
	$query = mysqli_query($connection, $sql);
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
	$page_rows = 20;

	$last = ceil($rows/$page_rows);

	//THIS MAKES SURE $LAST can not be less than 1
	if($last < 1){
		$last = 1;	
	}

	//estabilish the $pagenum variable
	$pagenum = 1;

	//Get the page number from URL vars if it is present, else it is = 1
	if(isset($pn)){
		$pagenum = preg_replace('#[^0-9]#', '', $pn);	
	
	}
	//This makes sure the page number is not below 1 or more than our last page
	if($pagenum < 1){
		$pagenum = 1;	
	}
	else if($pagenum > $last){
		$pagenum = $last;
	}
	//This set the range o rows to query for the chosen $pagenum
	$limit = 'LIMIT '.($pagenum -1) * $page_rows . ',' .$page_rows;
	
	$textline1 = "(<b>$rows</b>)";
	$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
	
	//Pagination control variable
	$paginationControl = "";
	//If there is more than 1 page of results
	if($last != 1){
		//If there is only one page we dont need link to previous and next pages
		if($pagenum > 1){
			$previous  = $pagenum - 1;
			$paginationControl .= '<a href="'.$_SERVER['PHP_SELF'].'?search_article='.$word.'&pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
			//Render clickable number links that should appear on the left of the target  page number;
			for($i = $pagenum-4; $i < $pagenum; $i++){
				if($i > 0){
					$paginationControl .= '<a href="'.$_SERVER['PHP_SELF'].'?search_article='.$word.'&pn='.$i.'">'.$i.'</a> &nbsp; &nbsp; ';	
				}
			}
		}
		else{
			$paginationControl .= 'Previous &nbsp; &nbsp; ';
			//Render clickable number links that should appear on the left of the target  page number;
			for($i = $pagenum-4; $i < $pagenum; $i++){
				if($i > 0){
					$paginationControl .= '<a href="'.$_SERVER['PHP_SELF'].'?search_article='.$word.'&pn='.$i.'">'.$i.'</a> &nbsp; &nbsp; ';	
				}
			}	
		}
		//Render the target page number, but without it being a link
		$paginationControl .= ''.$pagenum.'&nbsp;&nbsp;&nbsp;&nbsp;';
		//Render number clickable links that shoul appear on right
		 for($i = $pagenum+1; $i <= $last; $i++){
			$paginationControl .= '<a href="'.$_SERVER['PHP_SELF'].'?search_article='.$word.'&pn='.$i.'">'.$i.'</a> &nbsp; &nbsp; ';	 
			if($i >= $pagenum + 4){
				break;	
			}
		}
		//This does  the same as above, only checking if we are on the last page, and then generating the "Next"
		if($pagenum != $last){
			$next = $pagenum + 1;
			$paginationControl .='&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?search_article='.$word.'&pn='.$next.'">Next</a>';	
			
		}
		else{
			$paginationControl .='&nbsp; &nbsp Next</a>';
		}
			
	}
	
}

function img_resize($file, $newcopy, $w, $h, $ext){
	list($w_orig, $h_orig) = getimagesize($file);
	
	$scale_ratio = $w_orig / $h_orig;	
	if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($file);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($file);
    } else { 
      $img = imagecreatefromjpeg($file);
    }
    $tci = imagecreatetruecolor($w, $h);
    
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 84);
}
?>