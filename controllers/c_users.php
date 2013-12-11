<?php

class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
       
    } 

  
    public function signup() {
	
		# set up view
		$this->template->content = View::instance('v_users_signup');
		//$this->template->title = "Sign Up";
		//$view->user_name =$user_name;
		# render the template
		echo $this->template;
    }
	
	  public function p_signup()  {
	  //DB::instance(DB_NAME)->insert('users', $_POST);
	 // Router::redirect('/users/login');
		 //echo $view;
		 
		 //echo'<pre>';
		// print_r($_POST);
		// echo '</pre>';
		
		
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);	
		
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());  
		
		$user_id =DB::instance(DB_NAME)->insert('users',$_POST);
		echo 'your logged in';
		
		
	}
	
	public function login($error = NULL){ 
       // echo 'This is the login page';
		
		# set up view
		$this ->template->content = View::instance('v_users_login');
		
		#pass data to the view
		$this->template->content->error = $error;
		
		# Render the view
		echo $this -> template;
		
	}	

	
	public function p_login(){ 
       # sanitize the entered data from sql injection attack
		$_POST =DB::instance(DB_NAME)->sanitize($_POST);
		
		#hash a submitted password so we can compare to on in database
		$_POST['password']=sha1(PASSWORD_SALT.$_POST['password']);
		
		#search for the email password and password ... retrieve the token if its available
		
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			AND password ='".$_POST['password']."'";
			
		$token = DB::instance(DB_NAME)->select_field($q);	
		
		# if we dont find a match token in database it means login failed
		
		if(!$token){
		
		# send back to Login page with " error message"
		Router::redirect('/users/login/error');
		}
		# login passed
		else{
		setcookie("token",$token, strtotime('+2 weeks'),'/');
		
		# send back to main page
		Router::redirect('/');
		}
	
		
	}	

	
	
	
	
	    public function logout() {
        
		# generate and save a new token for next Login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# create the data array we will use with the update method.... we can only update one field so array has only one entry
		$data = Array("token" => $new_token);
		
		# do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token ='".$this->user->token."'");
		
		# delete the old token by setting it to a date in the past effectively logging them out
		setcookie("token","", strtotime('-1 yeat'), '/');
		
		# send them back to the main index
		Router::redirect("/");
		
		
		
		
		//echo 'This is the logout page';
    }

      public function profile ($user_name = NULL){

		# only logged in users are allowed
	  if(!$this->user){
			die('Members only. <a href = "/users/login" > </a>');
		}
		
		# Set up View
		$this-> template->content = View::instance('v_users_profile');
		$this-> template->title = "Profile";
		
		# render this template
		echo $this->template;
		
		}
		
		
		//$view=View::instance('v_users_profile');
		//echo $view;
		
		
		
		//$this -> template -> content = view::instance('v_users_profile');

		//$this->template->title = "Profile";

		//$this->template->content->user_name = $user_name;

		 //echo $this->template;
	}	

