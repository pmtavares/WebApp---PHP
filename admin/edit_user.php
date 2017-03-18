<?php
require_once("includes/site_header.php");
include("libs/list_users.php");

$id_user = $_GET['id_user'];
$success = @$_GET['success'];
$error = @$_GET['error'];

if(isset($id_user) || $id_user != ""){
	if($list_users != 0){
		foreach($list_users as $key => $value){
			$id_user = $value['id_user'];
			$name = $value['name'];
			$surname = $value['surname'];
			$ocupation = $value['ocupation'];
			$email = $value['email'];
			$username = $value['username'];
			$user_group = $value['user_group'];	
			$activated = $value['activated'];
			$user_photo = $value['user_photo'];
		}
	
?>

<div id="main_div">
	
    <?php 
		if(isset($error) && $error == "Could not update"){
			echo '<div class="alert-danger" role="alert">'.$error.'</div>';
		}
		else if(isset($success) && $success == "Successfuly Updated"){
			echo '<div class="alert-info">'.$success.'</div>';
		}
		
	?>
    <div id="edit_user_form">
    <h3>Edit User</h3>	
	 <form method="post" action="edit_user_ex.php" >
    		<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
            <label for="user_name">Name</label>
            <input type="text" name="user_name" id="user_name" class="text_input" value="<?php echo $name; ?>"/><br/>
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" class="text_input" value="<?php echo $surname; ?>"/><br/>
            <label for="ocupation">Ocupation</label>
            <input type="text" name="ocupation" id="ocupation"  class="text_input" value="<?php echo $ocupation; ?>"/><br/>
            <label for="email">Email</label>
            <input type="text" name="email" id="email"  class="text_input" value="<?php echo $email; ?>"/><br/>
            <label for="username">Username</label>
            <input type="text" name="username" id="username"  class="text_input" value="<?php echo $username; ?>"/><br/>
            <label for="user_group">Group</label>
         	<input type="text" name="user_group" id="user_group"  class="text_input" value="<?php echo $user_group; ?>"/><br/>
            <label for="activated">Activated</label>
           	<input type="text" name="activated" id="activated"  class="text_input" value="<?php echo $activated; ?>"/><br/>
            <label for="user_photo">Photo</label>
            <input type="text" name="user_photo" id="user_photo" class="text_input" value="<?php echo $user_photo; ?>"/><br/>
            <input type="submit" name="edit_user" id="edit_user" Value="Save"/>
            <a href="users_list.php"> Back</a>
    
    	</form>
        
	</div>


</div>
<?php
	}
	else{
		header("Location: users_list.php");
	}
}
else
{
	header("Location: users_list.php");
}

?>


<?php
require_once("includes/site_footer.php");
?>