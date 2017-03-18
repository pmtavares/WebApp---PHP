<?php
require_once("includes/site_header.php");
include("libs/list_users.php");

$id_user = $_GET['id_user'];
$success = @$_GET['success'];
$error = @$_GET['error'];

if(isset($id_user) || $id_user == ""){
	if($list_users != 0){
		foreach($list_users as $key => $value){
			$id = $value['id_user'];
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
		if(isset($error) && $error == "Could not delete"){
			echo '<div class="alert-danger" role="alert">'.$error.'</div>';
		}
		else if(isset($success) && $success == "Successfuly deleted"){
			echo '<div class="alert-info">'.$success.'</div>';
		}
		
	?>
    <div class="delete_article_video_form">
    <h3>Are you sure you want to delete this User?</h3>
    <img src="<?php echo "../".$user_photo; ?>" alt="" />
	 <form method="post" action="delete_user_ex.php" >
    		<input type="hidden" name="id_user" value="<?php echo $id;?>">
            <label for="user_name">Name</label>
            <input type="text" name="user_name" id="user_name" class="text_input" value="<?php echo $name; ?>" disabled/><br/>
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" class="text_input" value="<?php echo $surname; ?>" disabled/><br/>
            <label for="ocupation">Ocupation</label>
            <input type="text" name="ocupation" id="ocupation"  class="text_input" value="<?php echo $ocupation; ?>" disabled/><br/>
            <label for="email">Email</label>
            <input type="text" name="email" id="email"  class="text_input" value="<?php echo $email; ?>" disabled/><br/>
            <label for="username">Username</label>
            <input type="text" name="username" id="username"  class="text_input" value="<?php echo $username; ?>" disabled/><br/>
            <label for="user_group">Group</label>
         	<input type="text" name="user_group" id="user_group"  class="text_input" value="<?php echo $user_group; ?>" disabled/><br/>
            <label for="activated">Activated</label>
           	<input type="text" name="activated" id="activated"  class="text_input" value="<?php echo $activated; ?>" disabled/><br/>
                       
            <input type="submit" name="delete_user" id="delete_user" Value="Delete"/>
            <a href="users_list.php">Cancel</a>
    
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