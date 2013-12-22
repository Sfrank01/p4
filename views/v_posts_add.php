 <!DOCTYPE html>
<html>
 <body>
<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">

<div id ="postadd">
<form method='POST' action='/posts/p_add' >
<p>
	<h3> <label for='content'>New Post:</label></h3>
    <textarea name='content' id='content'></textarea><br><br>
	<label for="file">add image file:</label><br>
	<input type="file" name="file" id="file"><br><br>

    
    <input type='submit' value='submit'>

</form> 



</p>

</div>
</html>