<?php 
session_start();
require_once("functions/db_connect.php"); 
include_once("functions/util.php"); 
expiredSession();

$current_page = basename($_SERVER['SCRIPT_FILENAME']);
$msg_error = false; // Message to display when validading the fields
$user_pic = "";
?>

<?php 
//WHEN THE USER PRESS THE LOGIN BUTTON
if(isset($_POST["submit_login"])){
	
	//check if the fields are not left empty
	if($_POST["username"] == "" || $_POST["password"] == ""){
		echo "<script type='text/javascript'>alert('Please, fill out the fields')</script>";
		
	}
	else{
		//Declare the variable and sanitize the fields
		$username = sanitize(mysql_real_escape_string($_POST["username"]));
		$password = encript($_POST["password"]);	
			
		//SQL instruction to query the users database
		$sql = "SELECT * FROM users WHERE username = '$username' AND password='$password' AND activated='1'";
		$query = mysqli_query($connection, $sql);
		$num_rows = mysqli_num_rows($query);
		if($num_rows == 1){
			while($row = mysqli_fetch_assoc($query)){
				$usergroup = $row['user_group'];
				$_SESSION['user_pic'] = $row['user_photo'];
				if($usergroup == "Admin"){
					$_SESSION['admin'] = $username; 
					$_SESSION['username'] = $username;
					
					
				}
				else{
					$_SESSION['username'] = $username;	
					$_SESSION['created'] = time();
					
					
				}
					
			}
			
			
		}
		else{
			header("Location: errormsg.php?message=user_not_found");	
		}
		
	}
}
?>


<!--HTML Header starts here -->
<html>
<head>
<meta name="description" content="academic articles interaction" />
<meta name="keywords" content="science, mythology, astronomy" />
<meta name="author" content = "Pedro Tavares" />
<title>Science Facts</title>

<!--Link to css main File-->
<link type="text/css" href="css/style.css" rel="stylesheet" />

<!--Link to css_responsive File-->
<link rel="stylesheet" href="css/style_responsive.css"/>

<!--Link to get some fonts from google-->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald"/>

<!--Link for the slides file-->
<link href="js/anythingslider.css" rel="stylesheet">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.anythingslider.min.js"></script>
<script src="js/jsGeneral.js"></script>
<script src="js/functions.js"></script>

<!--Link for the fancybox files-->
<script src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" href="js/jquery.fancybox.css?v=2.1.5" media="screen">

</head>

<body>
  <div class="header">
  	<div id="sub_header1">
    	<div id="welcome_message">
        	Welcome to the Academic Interactions website.
            
		</div>
        <div id="user_identity">
        <?php 
			if(isset($_SESSION['username'])){ 
        		echo "<a href='edit_profile.php'><img src='".$_SESSION['user_pic']."'/>
					&nbsp;&nbsp;".ucfirst($_SESSION['username'])."</a>";
			}
		?>
        </div>
        <div id="social_links">
        	<table>
            	<tr>
            		<td class="social_icons"><a href="http://facebook.com" target="_blank" id="fb_icon"><img src="images/icons/facebook.png" alt="Find us on Facebook"/></a>
            		</td>
                    <td class="social_icons"><a href="http://google.com" target="_blank" id="g_icon"><img src="images/icons/google.png" alt="" /></a>
                    </td>
                	<td class="social_icons"><a href="http://youtube.com" target="_blank"><img src="images/icons/youtube.png" alt="" /></a>
                    </td>
                    <td class="social_icons"><a href="http://flickr.com" target="_blank"><img src="images/icons/flickr.png" alt=""/></a>
                    </td>
            	</tr>
            </table>
           
        
        </div>
       
    </div><!--End div sub_header1-->
    
    <div id="sub_header2">
    	<div id="login_link">
        	<!--Here will have a link for the login page and Logout-->
            <?php
				if(!isset($_SESSION['username'])){ 
			?>	
			<p id="open_menu">Login</p>
            <form action="index.php" method="post" name = "Login_form">
				<p>
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" required>
				</p>
				<p>
					<label for="password">Password: </label>
					<input type="password" name="password" id="password" required>
				</p>
				<p>
					<input type="submit" name="submit_login" id="submit_login" value="Login" onClick="return LoginValidator()" >
                    <a href="register.php" name="btnregister" id="btnregister">| Register |</a>
                    <a href="forgot_password.php" name="btnforgot" id="btnforgot"> Forgot password</a>
                   	
             	</p>
			</form>
            <?php
				}//end if
				else{
					
					echo "<p id='logout'><a href='logout.php'>Logout</a></p>";	
					
				}
				
			
			?>
        </div>
    	
        <div id="logo">
        	 
        	<a href="index.php"><img src="images/logoPrincipal.png" alt="Go to Home Page"/></a>
            
			             
        </div><!--End div logo-->
        
        <div id="menu_responsive"><p>Menu</p><div id="menu_button"><hr><hr><hr></div></div>
        <div id="main_menu">
        	<ul>	
        		   	<li><a href="index" <?php if($current_page == 'index.php'){echo "id='menu_here'";}?>>Home</a></li>
                    <li><a href="about_us" <?php if($current_page == 'about_us.php'){echo "id='menu_here'";}?>>About us</a></li>
            		<li><a href="articles" <?php if($current_page == 'articles.php'){echo "id='menu_here'";}?>>Articles</a></li>
            		<li><a href="media_list" <?php if($current_page == 'media_list.php'){echo "id='menu_here'";}?>>Media</a></li>
            		<li><a href="contact" <?php if($current_page == 'contact.php'){echo "id='menu_here'";}?>>Contact us</a></li>
            	
            </ul>
        </div><!--End div main_menu-->
        
    </div><!--End div sub_header2-->
  
  </div> <!--End div header-->
  
</body>
</html>