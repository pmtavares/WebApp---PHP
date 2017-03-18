<?php require_once("includes/site_header.php"); ?>
<?php checkSession(); ?>

<?php
$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$query = mysqli_query($connection, $sql);
$num_rows = mysqli_num_rows($query);
if($num_rows == 1){
	while($row = mysqli_fetch_assoc($query)){
		$id_user = $row['id_user'];
		$username = $row['username'];
		$name = $row['name'];
		$surname = $row['surname'];
		$ocupation = $row['ocupation'];
		$email = $row['email'];
		$user_photo = $row['user_photo'];	
	}
	
}
else{
	echo "<div id='main_wrapper'>";
	echo "An internal error ocurred, please try again later!";
	echo "</div>";	
}

?>
<head>
<script src="js/ajax.js"></script>
</head>
<div class="main_wrapper">
	<div id="menu_user_update">
    	<p id="invalid_field_message2" class="invalid_field_message"></p>
    	<h3>Update Profile</h3>
        <?php include("includes/menu_user.php"); ?>
    	
   </div>
    <div id="form_edit">
    	<img src="<?php echo $user_photo; ?>" alt="<?php echo $username; ?>' Profile" title="<?php echo $username; ?>'s Profile" /><br/>
        <p id="over_user"><?php echo ucfirst($username); ?></p>
    	<form method="post" action="update_ex.php" id="edit_profile_form" enctype="multipart/form-data" >
    			<p>
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                <input type="hidden" name="user_photo" value="<?php echo $user_photo; ?>" />
                <label for="user_name">Name:</label> 
                <input type="text" id ="user_name" name="user_name" value= "<?php echo $name; ?>" required class="input_resgister"/> <br/>
                <label for="user_surname">Surname:</label> 
                <input type="text" id ="user_surname" name="user_surname" value= "<?php echo $surname; ?>" required class="input_resgister"/> <br/>
                <label for="user_ocupation">Ocupation:</label> 
                <input type="text" name="user_ocupation" id="user_ocupation"value="<?php echo $ocupation; ?>" required class="input_resgister"/><br/>
                <label for="user_email">Email:</label> 
                <input type="email" id ="user_email" name="user_email" value= "<?php echo $email; ?>" required class="input_resgister" /> <br/>
                <label for="profile_pic">Profile Image</label>
              	<input type="file" name="profile_pic" id= "profile_pic" class="input_resgister" value="Upload your image" /><br/>
             	</p>
              	<p><br/>
                <input type="submit" value="Update" class="button_edit" name="update_profile_record" /> 
                <a href="articles.php">Back</a>
              </p>
       
    	</form>
    </div>
	<div id="change_password">Change your Password
    	<form id="edit_password" name="edit_password" action="update_ex.php" method="POST">
        	<input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
            <label for="old_password">Old Password: *</label> 
            <input type="password" id ="old_password" name="old_password"  class="input_resgister" onChange="check_oldpass();"/><div id="check_oldPas"></div> <br/>
            <label for="new_password">New Password: *</label> 
            <input type="password" id ="new_password" name="new_password"  class="input_resgister"/> <br/>
            <label for="repeat_password">Repeat Password: *</label> 
            <input type="password" name="repeat_password" id="repeat_password" class="input_resgister"/><br/>
        	<p>
			<br/>
            <input type="submit" value="Save" class="button_edit" name="update_password_record" onclick=" return passwordValidator();"/> 
            <div id="status_password"></div>
            </p>
        </form>
        
    </div>
    <noscript>
            Oooops! Your JavaScript is turned-off. If you do not turn it on, you might not be able to enjoy everything!
    </noscript>

</div><!--End wrapper-->


<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>