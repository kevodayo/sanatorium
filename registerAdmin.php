<?php

require_once 'core/init.php';

	//var_dump(Token::check(Input::get('token')));
	if(Input::exists()){
		if(Token::check(Input::get('token'))){
		//echo 'submitted';
		//echo Input::get('name');
		$validate = new Validate();
		$validation = $validate->check($_POST,array(

		'name' => array(
			'required' => true,
			'min' => 2,
			'max' => 20,
			'unique' =>'Admin'
		),
		'password' => array(
			'required' => true,
			'min' => 6,
		),
		'password_again' => array(
			'required' => true,
			'matches' => 'password'
		)
	));
	if ($validation->passed()) {
		# code...
		//register user
		//echo 'Passed';
		$user = new Admin();
		$salt = Hash::salt(32);
		//die();
		try{

			//echo 'insert';
			$user->create(array(

				'password' => Hash::make(Input::get('password'),$salt),
				'name' => Input::get('name'),
				'salt' => $salt
			));
			Session::flash('Success');
		    //header("location : index.php");
		    //die();
			 //Redirect::to('index.php',false);
			echo "<script>window.open('login.php','_self')</script>";

		}catch(Exception $e){
			die($e->getMessage());
		}
	}else{
		//output errors
		//print_r($validation->errors());
		foreach ($validation->errors() as $error) {
			# code...
			echo $error, '<br>';
		}
	}
	
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registry section</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form action="" method="post">
	<div class="login-box">
	<h1>USER REGISTRATION PAGE</h1>

	<div class="textbox">
		<label for="name">Username</label>
		<input type="text" name="name" id="name" value="" autocomplete="off">
	</div>

	<div class="textbox">
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="textbox">
		<label for="password_again">Repeat the Password</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" name="Register" value="Register">
</div>
</form>
</body>
</html>