<!DOCTYPE html>
<html>
<head>
	
</head>

<body>
<img src="/images/V_Logo.png" alt="logo" width="180" height="180" class="logo" >
<div id="greeting">
<?php if($user): ?>

	<h2>Hello <?=$user->first_name?>!</h2>
<?php else: ?>	
	<h2>Welcome to v-pop</h2>
	<h3>Please Signup or Login</h3>
<?php endif; ?>	
</div>


</body>

</html>