<?php
	class posts_controller extends base_controller {

		public function __construct() {
			parent::__construct();

			# Make sure user is logged in if they want to use anything in this controller
			if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }

 public function p_add() {


 

	if($_POST['file'] == "Upload"){$image =$_FILES["file"]["name"];$uploadedfile = $_FILES['file']['tmp_name'];
	
    if ($image){$filename = stripslashes($_FILES['file']['name']);$extension = getExtension($filename); $extension = strtolower($extension);    
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {$change='Invalid Picture';$errors=1;}
        else{$size=filesize($_FILES['file']['tmp_name']);
            if ($size > $max_size*1024){$change='File too big!';$errors=1;}
            else{
                if($extension=="jpg" || $extension=="jpeg" ){$uploadedfile = $_FILES['file']['tmp_name'];$src = imagecreatefromjpeg($uploadedfile);}
                else if($extension=="png"){$uploadedfile = $_FILES['file']['tmp_name'];$src = imagecreatefrompng($uploadedfile);}
                else {$src = imagecreatefromgif($uploadedfile);}
                echo $scr;
                list($width,$height)=getimagesize($uploadedfile);

                //MAIN IMAGE
                $newwidth=300;
                $newheight=($height/$width)*$newwidth;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                $kek=imagecolorallocate($tmp, 255, 255, 255);
                imagefill($tmp,0,0,$kek);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

                //Does Directory Exhist?
                if(is_dir("/images/")==FALSE){mkdir("/images/");}

         


		 //Build file path and SAVE
                $filepath = $_SERVER['DOCUMENT_ROOT']."images/".md5(genRandomString().$_FILES['file']['name']).".".$extension;
                imagejpeg($tmp,$filepath,100);
                imagejpeg($tmp,$filepath,100);
                imagedestroy($src);
                imagedestroy($tmp);

                //ERROR HANDLING
  if($_FILES["file"]["size"]<=0){$errors=1;$change='No file';}
                if($errors!=1){$change='Image Uploaded!';}
            }
        }
    }
}

 

        # Associate this post with this user
       $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # Quick and dirty feedback
        echo "Your post has been added. <a href='/posts/add'>Add another</a>";	
		
	
 }


	
	
	

 public function delete() {

    # Set up the View
    $this->template->content = View::instance('v_posts_delete');
    $this->template->title   = "delete";
 
	  # Query
    $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
			posts.post_id,
            users.first_name,
            users.last_name
		
        FROM posts
		
        JOIN users 
            ON posts.user_id = users.user_id
        WHERE users.user_id = '.$this->user->user_id;
			

    # Run the query
    $posts = DB::instance(DB_NAME)->select_rows($q);

    # Pass data to the View
    $this->template->content->posts = $posts;
	
	echo $this->template;
   }
		
	
	
	public function p_delete() { 
	
	 # Associate this post with this user
       
	
   $q = 'SELECT 
            posts.content,
			posts.post_id,
            posts.file,
        FROM posts
	  WHERE users.user_id = '.$this->user->user_id;
	

     $posts = DB::instance(DB_NAME)->select_rows($q);
 		
	
    # Do the delete
  DB::instance(DB_NAME)->delete('posts', $posts);

	    # Quick and dirty feedback
        echo "Your post has been deleted. <a href='/posts/delete'>Delete another</a>";

}	  
		
public function index() {
	
    # Set up the View
    $this->template->content = View::instance('v_posts_index');
    $this->template->title   = "Posts";

    # Query
    $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;

    # Run the query
    $posts = DB::instance(DB_NAME)->select_rows($q);

    # Pass data to the View
    $this->template->content->posts = $posts;

    # Render the View
    echo $this->template;

}

public function users() {

    # Set up the View
    $this->template->content = View::instance("v_posts_users");
    $this->template->title   = "Users";

    # Build the query to get all the users
    $q = "SELECT *
        FROM users";

    # Execute the query to get all the users. 
    # Store the result array in the variable $users
    $users = DB::instance(DB_NAME)->select_rows($q);

    # Build the query to figure out what connections does this user already have? 
    # I.e. who are they following
    $q = "SELECT * 
        FROM users_users
        WHERE user_id = ".$this->user->user_id;

    # Execute this query with the select_array method
    # select_array will return our results in an array and use the "users_id_followed" field as the index.
    # This will come in handy when we get to the view
    # Store our results (an array) in the variable $connections
    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    # Pass data (users and connections) to the view
    $this->template->content->users       = $users;
    $this->template->content->connections = $connections;

    # Render the view
    echo $this->template;
}
public function follow($user_id_followed) {

    # Prepare the data array to be inserted
    $data = Array(
        "created" => Time::now(),
        "user_id" => $this->user->user_id,
        "user_id_followed" => $user_id_followed
        );

    # Do the insert
    DB::instance(DB_NAME)->insert('users_users', $data);

    # Send them back
    Router::redirect("/posts/users");

}

public function unfollow($user_id_followed) {

    # Delete this connection
    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    DB::instance(DB_NAME)->delete('users_users', $where_condition);

    # Send them back
    Router::redirect("/posts/users");

}


}