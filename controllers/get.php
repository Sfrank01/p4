<?php

// connect to database//
		mysql_connect("localhost", "root", "") or die (mysql_error());
		mysql_select_db( "marinebo_test") or die (mysql_error());
		
		
		$id = addslashes($_REQUEST[post_id]);
		$image=mysql_query("SELECT * posts WHERE post_id =$id");
		$image=$image['image'];
		
		header ("Content-type:image/png");
		echo $image;
?>
		