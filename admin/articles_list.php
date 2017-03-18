<?php
require_once("includes/site_header.php");
include("libs/list_articles.php");

?>
<body>
<div id="main_div">
<h3>Articles List</h3>
<table>
	<tr>
    	<td>Article Title</td>
        <td>Posted on</td>
        <td>Category</td>
        <td>User</td>
        <td>Views</td>
        <td>Status</td>
     </tr>
     <tr>
	<?php

	if($list_articles != 0){
		foreach($list_articles as $key => $value){
			$id = $value['id_article'];
			$title = $value['title_article'];
			$date = $value['date_posted'];
			$category = $value['cat_article'];
			$user = $value['user_posted'];
			$views = $value['views_article'];
			$status = $value['status_article'];	
		?>
        <td><?php echo $title; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $category; ?></td>
        <td><?php echo $user; ?></td>
        <td><?php echo $views; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="edit_article.php?id_article=<?php echo $id; ?>">  Edit</a></td>
        <td><a href="delete_article.php?id_article=<?php echo $id; ?>"> | Delete</a></td>
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