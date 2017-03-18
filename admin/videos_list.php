<?php
require_once("includes/site_header.php");
include("libs/list_videos.php")


?>
<body>
<div id="main_div">
<h3>Videos List</h3>
<table>
	<tr>
    	<td>Video Title</td>
        <td>Posted on</td>
        <td>Category</td>
        <td>User</td>
        <td>Views</td>
        <td>Status</td>
     </tr>
     <tr>
	<?php

	if($list_videos != 0){
		foreach($list_videos as $key => $value){
			$id = $value['id_video'];
			$title = $value['title_video'];
			$date = $value['date_posted'];
			$category = $value['cat_video'];
			$user = $value['user_video'];
			$views = $value['views_video'];
			$status = $value['status_video'];	
		?>
        <td><?php echo $title; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $category; ?></td>
        <td><?php echo $user; ?></td>
        <td><?php echo $views; ?></td>
        <td><?php echo $status; ?></td>
        <td></td>
        <td><a href="edit_video.php?id_video=<?php echo $id; ?>">  Edit</a></td>
        <td><a href="delete_video.php?id_video=<?php echo $id; ?>"> | Delete</a></td>
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