<?php
include("includes/site_header.php");
?>
<div class="main_wrapper">
<?php
if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['e']) && isset($_GET['n']) && isset($_GET['id'])){
	$username = preg_replace("#[^a-z0-9]#i", "", $_GET['u']);
	$id = $_GET['id'];
	$password = $_GET['p'];
	$name = preg_replace("#[^a-z0-9]#i", "", $_GET['n']);
	$email = $_GET['e'];
	$email_md5 = md5($email);
	//Check the data against the database
	$sql = "SELECT * FROM users WHERE username='$username' AND name = '$name' AND password = '$password' AND email='$email' and activated='0'";
	$query = mysqli_query($connection, $sql);
	$num_rows = mysqli_num_rows($query);
	
	if($num_rows == 0){
		header("Location: errormsg.php?message=error");	
		echo "<div class='alertMsg'>Could not activate the user. <br/>Try again later.
			<a href='index.php'>Go Back</a>
			</div>";
		
	}
	else{
		$sql = "UPDATE users SET activated = '1' WHERE id_user='$id' AND activated='0'";
		$query = mysqli_query($connection, $sql);
		echo "<div class='alertMsg'>User activated. Now you can log in.</div>";
			
	}
	
}
else{
	header("Location: index.php");	
	
	
}


?>

</div>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>