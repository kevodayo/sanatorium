<?php 
	require_once 'core/init.php';
	if(Input::exists()){
		//echo 'success';
		if(Token::check(Input::get('token'))){
			$validate = new Validate();
			$validation = $validate->check($_POST,array(
				'name' => array('required' => true),
				'password' => array('required' => true)
			));
			//check if the validation passes
			if($validation->passed()){
				//log user in
				$admin = new Admin();
				$login = $admin->login(Input::get('name'),Input::get('password'));

				//check if the login is successful
				if($login){
					//echo 'success';
					echo "<script>window.open('includes/404.php','_self')</script>";
				}
				else{
					echo '<p>Sorry,Logging in failed</p>';
				}
			}else{
				foreach ($validation->errors() as $errror) {
					# code...
					echo $errror,'<br>';
				}
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login section</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="" method="post">
	<div class="login-box">
	<h1>HOSPITAL MANAGEMENT SYSTEM</h1>
	<div class="textbox">
		<i class="fa fa-user" aria-hidden="true"></i>
		<input type="text" placeholder="Enter Username" name="name" value="">
	</div>	

	<div class="textbox">
		<i class="fa fa-lock" aria-hidden="true"></i>
		<input type="password" placeholder="Enter Password" name="password" value="">
	</div>	
	 
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
		<input type="submit" value="Patient">
		<input type="submit" value="Admin">
		<input type="submit" value="Receptionist">
		<input type="submit" value="Doctor">
		<?php echo '<p>For new Users you need to<a href="registerAdmin.php"> Register</a></p>';  ?>
	</div>
	</form>

</body>
</html>
