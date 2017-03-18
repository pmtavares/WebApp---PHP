<?php
require_once("includes/site_header.php");
?>

<?php
$msg_error = false; // Message to display when validading the fields

if(isset($_POST['send_register'])){
	//GET THE FIELDS FROM THE REGISTER FORM AND SANITIZE ALL
	if($_POST['first_name'] != "" || $_POST['second_name'] != "" || $_POST['register_email'] != "" ||
		$_POST['confirm_email'] != "" || $_POST['register_phone'] != "" || $_POST['password_user']!= "" ||
		$_POST['confirm_password'] != "" || $_POST['username_register'] ){
			
		$first_name = sanitize($_POST['first_name']);	
		$second_name = sanitize($_POST['second_name']);
		$username = preg_replace('#[^a-z0-9]#i', '',sanitize($_POST['username_register']));
		$email = sanitize($_POST['register_email']);
		$confirm_email = sanitize($_POST['confirm_email']);
		$register_phone = preg_replace('/[^0-9]/', '',sanitize($_POST['register_phone']));
		$password_user = $_POST['password_user'];	
		$pass_md5 = md5($password_user);
		$enc_pass = encript($password_user);
		$phone = $_POST['register_phone'];
		$confirm_password = $_POST['confirm_password'];
		
		//CHECK THE LENGHT OF SOME FIELDS
		if(strlen($first_name) > 30 || strlen($email)> 50 || strlen($password_user) < 5 || strlen($username) > 30){
			$msg_error =  "Please check the lenghts of the fields: First Name, email, username or password. <br/>Click <a href='register.php'>here </a>to go back.";
			
		}
		else{
			if($email != $confirm_email){
				$msg_error =  "The email and the confirmation must match. <br/>Click <a href='register.php'>here </a>to go back.";	
			}
			else if(is_numeric($username[0])){
				$msg_error =  "The username must begin with a letter. <br/>Click <a href='register.php'>here </a>to go back.";
			}
			else if($password_user != $confirm_password){
				$msg_error =  "The password and the confirmation must match. <br/>Click <a href='register.php'>here </a>to go back.";	
			}
			else{ 
				//CHECK IF THE USER ALREADY EXISTS
				$sql = "SELECT * FROM users where username='$username'";
				$query = mysqli_query($connection, $sql);
				$num_rows = mysqli_num_rows($query);
				//CHECK IF THE EMAIL ALREADY EXISTS
				$sql1 = "SELECT * FROM users where email='$email'";
				$query1 = mysqli_query($connection, $sql1);
				$num_rows1 = mysqli_num_rows($query1);
				if($num_rows > 0){
					$msg_error =  "User ".$username." already exists. <br/>Click <a href='register.php'>here </a>to go back.";	
				}
				else if($num_rows1 > 0){
					$msg_error =  "Email ".$email." already exists. <br/>Click <a href='register.php'>here </a>to go back.";
				}
				else{
					//ADD THE USER
					$sql = "INSERT INTO users VALUES('','$first_name', '$second_name', '','$email','$username','$enc_pass', 'user', '0', 'images/users/default.jpg', '$phone')";
					$query = mysqli_query($connection, $sql);
					$msg_error = "";
					$user_id = mysqli_insert_id($connection);
					//SEND AN EMAIL TO THE NEW USER
					$to = $email;
					$from = "autoresponse@webinter.com";
					$headers = "From: $from\n";
					$headers .= "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
					$subject = "Withinfra Account Activation";
					$msg = '<!DOCTYPE html><html>
							<head>
							<meta charset="UTF-8"><title>Web Interaction message</title>
							</head>
							<body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
							<div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
							<a href="http://www.withinfra.com/dt249">
							<img src="http://withinfra.com/dt249/images/logoPrincipal.png" width="36" height="30" 
								alt="withinfra.com" style="border:none; float:left;">
							</a>WithInfra Account Activation
							</div>
							<div style="padding:24px; font-size:17px;">
							Hello '.$username.',<br /><br />
							Click on the link below to activate your account when ready:<br /><br />
							<a href="http://www.withinfra.com/dt249/activation.php?id='.$user_id.'&u='.$username.'&p='.$enc_pass.'&e='.$email.'&n='.$first_name.'">
							Click here to activate your account now</a><br /><br />
							Login after successful activation using your:<br />* E-mail Address: <b>'.$email.'</b>
							</div>
							</body></html>';
					mail($to, $subject, $msg, $headers);
					//exit();
				}
			} // END ELSE
		}//END ELSE
		
	}// END IF
	else{
		$msg_error = "You can't leave fields empty, go <a href='register.php'>BACK</a> and try again";
		
		
	}
}else{
	header("Location: register.php");	
}


?>

<div class="main_wrapper">

<?php 
	if($msg_error){ ?>
		<div id="validade_registration">
			<h3><?php echo $msg_error; ?></h3>
		</div>
<?php 
	}// END IF 
	else{
				
?>
<div id="confirm_register">
	<h3>The Following user has been registered...</h3>
	<p>First Name: <?php echo $first_name; ?></p>
	<p>Second Name: <?php echo $second_name; ?></p>
	<p>Email: <?php echo $email; ?></p>
	<p>Phone: <?php echo $register_phone; ?></p>
    <p>However, your account still need to be activate.</p>
    <p>Check your email in order to activate your account. Once your account is activated,
    you can log in and enjoy  all the features from the website.</p>
    <h3>Thank you <?php echo $first_name; ?></h3>
    <p><a href="index.php">Back</a></p>
</div>


<?php } //END ELSE ?>

</div>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>