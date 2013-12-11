<?php
class practice_controller extends base_controller {

  public function generate_new_hashes() {

  

    $q = "SELECT * 
		FROM users";

  $users = DB::instance(DB_NAME)->select_rows($q);

     foreach($users as $user) {

      $data = Array(
			'password' => sha1(PASSWORD_SALT.strtolower($user['first_name'])),
			'token'    => sha1(TOKEN_SALT.$user['email'].Utils::generate_random_string())
			);

      

      # This is bad...never do a update in a loop
	DB::instance(DB_NAME)->update_row('users', $data, 'WHERE user_id = '.$user['user_id']);

     }
	 }
	 }

  


 /*-------------------------------------------------------------------------------------------------

   Demonstrating an alternative way to handle signup errors.
   In this method, we're submitting the signup form to itself.
   # Static
 
 
