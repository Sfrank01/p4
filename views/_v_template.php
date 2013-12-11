<!DOCTYPE html>
<html>
<head>

	<title><?php if(isset($title)) echo $title; ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
<nav>
	<menu>
				<li><a href ='/'><h3> Home</h3></a></li>
			<?php if ($user): ?>
				<li><a href ='/posts/add'><h3> Add Post</h3></a></li>
				<li><a href ='/posts/'><h3> View Posts</h3></a></li>
				<li><a href ='/posts/users'><h3> Follow Users</h3></a></li>
				<li><a href ='/users/logout'><h3> Logout</h3></a></li>
			<?php else: ?>
				<li><a href ='/users/signup'><h3> Sign up</h3></a></li>
				<li><a href ='/users/login'> <h3>Log In</h3></a></li>
			<?php endif;?>
			


	</menu>
</nav>
<div id="greeting-login">	
	<?php if ($user): ?>
			
		<div id="login-greeting">	<h3>You are logged in as<br> <?=$user->first_name?> <?=$user->last_name?><br></h3><div>
	
	<?php endif; ?>		
	<br><br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</div>	
	
	
</body>
</html>