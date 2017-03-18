<?php
require_once("includes/site_header.php");
include("libs/list_users.php");


?>
<body>
<div id="main_div">
<h3>Users List</h3>
<table>
	<tr>
    	<td>Name</td>
        <td>Surname</td>
        <td>Ocupation</td>
        <td>Email</td>
        <td>Username</td>
        <td>Group</td>
        <td>Activated</td>
        <td>Photo Link</td>
     </tr>
     <tr>
	<?php

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
			
		?>
        
        <td><?php echo $name; ?></td>
        <td><?php echo $surname; ?></td>
        <td><?php echo $ocupation; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $username; ?></td>
        <td><?php echo $user_group; ?></td>
        <td><?php echo $activated; ?></td>
        <td><?php echo $user_photo; ?></td>
        <td></td>
        <td><a href="edit_user.php?id_user=<?php echo $id; ?>">  Edit</a></td>
        <td><a href="delete_user.php?id_user=<?php echo $id; ?>"> | Delete</a></td>
        </tr>
        <?php	
				
		}
	
	}

?>	
		
	
</table>

</div>
</body>


<?php
require_once("includes/site_footer.php");
?>