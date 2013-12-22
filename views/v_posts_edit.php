<!DOCTYPE html>
<html>
<body>


<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">
<div id ="article">

<?php foreach($posts as $post): ?>



   <? php echo htmlspecialchars($posts['content']),ENT_QUOTES,
   'UTF-8');?>
	<?php endforeach; ?>
</div>

