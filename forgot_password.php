<?php require_once("includes/site_header.php"); ?>
<div class="main_wrapper">
<?php 
if(!isset($_POST['user_password'])){
?>	
	<div id="div_password">
    <h3>Forgot your password?</h3>
    <p>Enter your email address in order to get a new password</p>
    <form method="POST" action="forgot_password.php">
    	<input type="text" name="user_email" id="user_email"/>
        <input type="submit" value="Send" name="user_password" id="user_password"/>
        <a href="index.php">Cancel</a>
    </form>
    
    </div>

<?php
}
else{
	$email = $_POST['user_email'];
	$sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
	$query = mysqli_query($connection, $sql);
	$num_rows = mysqli_num_rows($query);
	if($num_rows > 0){
		while($row = mysqli_fetch_assoc($query)){
			$id = $row['id_user'];
			$username = $row['username'];
			$email = $row['email'];
			$password = $row['password'];	
		}
		$username_cut = substr($username, 0,3);
		$num = rand(1000, 9999);
		$temp_pass = "$username_cut$num";
		$temp_pass_enc = sanitize(encript($temp_pass));
		
		//UPDATE THE USER PASSWORD
		$sql = "UPDATE users SET password = '$temp_pass_enc' WHERE id_user = '$id' LIMIT 1";
		$query = mysqli_query($connection, $sql);
		
		//SEND THE EMAIL TO THE USER WITH THE NEW PASSWORD
		$to = $email;
		$from = "autoresponse@webinter.com";
		$headers = "From: $from\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
		$subject = "Web Interaction Temporary Password";
		$msg = "<h2>Hello ".$username. "</h2> <p>This is an automated message from withinfra. If you did not request another password, please
		disregard this email.</p><p>You indicated that you forgot your password. We can generate a temporary password for you to log in with, 
		then once logged in you can change your password to anything you like.</p><p>From now on, your password to login will be:
		<br /><b>".$temp_pass."</b><br/>. In order change your password, you must login, go to your profile page and then change your
		password.</p> ";
		
		//CHANGE THE EMAIL TO TH USER
		if(mail($to, $subject, $msg, $headers)){
			echo "Success! Check your email account!<a href='index.php'> Home Page</a>";
			
			
		}
		else{
			echo "Failed to send your email! <a href='forgot_password.php'> Back</a>";
			
		}	
		
		
	}
	else{
		echo "This email does not exists. Please try another email.";
	}
}
?>
</div>
<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>