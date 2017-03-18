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
	$escape = mysql_real_escape_string($htmlchar);
	return $escape;

}


//check if the user is loggedin
function loggedin(){
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
		return true;	
	}else{
		return false;	
	}
	
}

//Check if the user  or manager is loggedin
function checkSession(){
	if(!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
		header("Location: ../index.php");
		exit();
	}
	

}
//Check if the user is logged in more than 30 min, if so, expire the session
function expiredSession(){
	$inactive = 1800; // could be any value the admin wants.
	if(isset($_SESSION['created'])){
		if(time() - $_SESSION['created'] > $inactive){
			session_destroy();
			header("Location: errormsg.php?message=session_expired");	
		}
		
	}

}
?>