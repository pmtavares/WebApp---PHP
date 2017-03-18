<?php 
session_start();
//require_once("db_connect.php"); 
require_once("connect.php");
include("util.php");
checkSession();

$admin = $_SESSION['admin'];
?>

<!--HTML Header starts here -->
<html>
<head>
<title>Management</title>

<!--Link to css main File-->
<link type="text/css" href="css/main.css" rel="stylesheet" />

<!--Link to get some fonts from google-->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald"/>

</head>

<body>
  <div id="header">
  	<div id="sub_header1">
    	<div id="welcome_message">
        	Web site Manager: Hello <?php echo $admin; ?>!
                      
		</div>
        
    </div><!--End div sub_header1-->
    
    <div id="sub_header2">
       	
        <div id="logo">
        	<a href="../index.php"><img src="../images/logoPrincipal.png" alt="Go to Home Page"/></a>
        </div><!--End div logo-->
        <div id="main_menu">
        	<ul>	
            		<li><a href="index.php" >Home</a></li>
        		   	<li><a href="articles_list.php" >Articles</a></li>
                    <li><a href="videos_list.php" >Videos</a></li>
            		<li><a href="users_list.php">Users</a></li>
                    <li><a href="logout.php">Logout</a> </li>
            		            	
            </ul>
        </div><!--End div main_menu-->
        
    </div><!--End div sub_header2-->
  
  </div> <!--End div header-->
</body>