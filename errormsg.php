<!--
* 	This Page is responsible to handle all the php error messages
*	Any time of error that might be display to the user, will come from this page

-->

<style>
.view{
	color: #AEDA18;
	height:80px;
	width:600px;
	font-size:22px;
	
	
}
</style>


<?php
require_once("includes/site_header.php");
$message = $_GET['message'];
$msg = "";

switch ($message){
	case  "content_not_found":
		$msg ="Sorry, could not retrieve information about this content";
		break;
	case  "error":
		$msg= "An error occurred, please try again later";
		break;
	case "Could_not_validade_fields":
		$msg= "Sorry, an error occur. Please go back and try it again.";
		break;
	case "user_not_found":
		$msg= "Sorry, this user was not found or is not yet activated, try again later!";
		break;
	case "session_expired":
		$msg = "Your session has expired, please log in again!";
		break;
	default:
		$msg= "Something unspectable happened, please try again later!";
		break;	


}



?>
<div class="main_wrapper">
<div class="view"><?php echo $msg; ?> 
</div>
<a href="index.php">Go back</a>
</div>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>