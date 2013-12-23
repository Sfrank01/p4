<!DOCTYPE html>
<html>
 <body>

<img src="/images/V_Logo_75.png" alt="logo" width="70" height="70" class="logo4">
<div id ="postimage">



<form action='v_posts_image.php' method='POST' enctype='multipart/form-data'>

	add image file:<br>
	
	<input type="file" name="image" ><br><br>

    <input type='submit' value='upload'>

</form> 


<?php
// connect to database//
		mysql_Connect("localhost", "root", "") or die ( mysql_error() );
		mysql_Select_db( "marinebo_test") or die ( mysql_error() );
      
		// files properties//
		echo $file= $_FILES ['image']['tmp_name'];
		
		if(!isset ($file))
		echo "please select an image";
		
		else
			{
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name'] ));
			$image_name = addslashes($_FILES['image']['name'] );
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			$user_id  = $this->user->user_id;
		if ($image_size==FALSE)
			echo "not an image";
		else
			{
			if(! $insert= mysql_query("INSERT INTO store VALUES('','$image_name','$image')"))
			 
				echo "Problem uploading image";
			  # Associate this post with this user
			#$_POST['user_id']  = $this->user->user_id;

       
        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
       # DB::instance(DB_NAME)->insert('store', $_POST);
		#else
			#{
			#$lastid=mysql_insert-id();
			#echo "Image upload.<p/> Your image: <p/><img src= get.php>id=$post_id>";	
			
	}
	}	
			
?>

	

 </body>

</html>
