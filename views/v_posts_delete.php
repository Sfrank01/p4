<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">
<div id ="postdelete">

<?php foreach($posts as $post): ?>



     <p> <?=$post['first_name']?>  Posted: 
	 <?=$post['content']?>
	 	 (<?=$post['post_id']?>)
		 
		 
	 <form method="delete"  action"p_delete" >
		
		<input type ="submit" value="Delete">
</form>
<?php endforeach; ?>

</div>

