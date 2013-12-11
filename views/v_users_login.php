
<img src="/images/V_Logo.png" alt="logo" width="180" height="180" class="logo2">
<div id ="login">

<form method = 'POST' action='/users/p_login'>

<h3>Email</h3>
<input type= 'text'  name='email'>
<br><br>

<h3>Password</h3>
<input type= 'password'  name='password'>
<br><br>

<?php if(isset($error)): ?>
		<div class ='error'>
			<h3>Login failed. Please double check your email and password.</h3>
		</div>
			<br>
<?php endif; ?>			



<input type= 'submit'  value='login'>
</form>

</div>
