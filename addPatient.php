<?php
require_once 'core/init.php';
$db = Db::getInstance();
//echo 'Yess';
if(Input::exists()){
		if(Token::check(Input::get('token'))){
		//echo 'submitted';
		//echo Input::get('name');
		$validate = new Validate();
		$validation = $validate->check($_POST,array(

		'fullname' => array(
			'required' => true,
			'min' => 2,
			'max' => 20
		),
		'password' => array(
			'required' => true,
			'min' => 6,
		),
		'password_again' => array(
			'required' => true,
			'matches' => 'password'
		),
		'age'=> array(
			'required' => true
		)
	));
	if ($validation->passed()) {
		# code...
		//register user
		//echo 'Passed';
		$user = new Patient();
		$salt = Hash::salt(32);
		//die();
		try{

			//echo 'insert';
			$fullname=$_POST['fullname'];
			$address=$_POST['address'];
			$gender=$_POST['gender'];
			$email=$_POST['email'];
			$date=$_POST['date'];
			$age=$_POST['age'];
			$status = $_POST['status'];
			$password=($_POST['password']);
			$user->create(array(

				'password' => Hash::make($password,$salt),
				'fullname'=>$fullname,
				'address'=>$address,
				'gender'=>$gender,
				'email'=>$email,
				'regdate'=>$date,
				'age'=>$age,
				'studentstatus'=>$status,
				'salt' => $salt
			));
			Session::flash('Success');
		    //header("location : index.php");
		    //die();
			 //Redirect::to('index.php',false);
			// if($sql)
			// {
			echo "<script>alert('Patient info added Successfully');</script>";
			//header('location:manage-doctors.php');

			//}

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
// if(isset($_POST['submit']))
// {	
// 	// echo 'Yess';
// 	$fullname=$_POST['fullname'];
// 	$address=$_POST['address'];
// 	$gender=$_POST['gender'];
// 	$email=$_POST['email'];
// 	$date=$_POST['date'];
// 	$age=$_POST['age'];
// 	$status = $_POST['status'];
// 	$password=($_POST['password']);
// 	// $sql=mysqli_query($con,"insert into doctor(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");

// 	$sql = $db->insert('Patient',array('fullname'=>$fullname,
// 									  'address'=>$address,
// 									  'gender'=>$gender,
// 									  'email'=>$email,
// 									  'regdate'=>$date,
// 									  'age'=>$age,
// 									  'studentstatus'=>$status ,
// 									  'password'=>$password));
// if($sql)
// {
// echo "<script>alert('Patient info added Successfully');</script>";
// //header('location:manage-doctors.php');

// }
// }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Add Patient</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
<script type="text/javascript">
function valid()
{
 if(document.adddoc.npass.value!= document.adddoc.cfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.adddoc.cfpass.focus();
return false;
}
return true;
}
</script>

	</head>
	<body>
		<div id="app">		

			<div class="app-content">
				
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Add Patient</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Add Patient</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Add Patient</h5>
												</div>
												<div class="panel-body">
									
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="fullname">
																Patient Name
															</label>
							
								<input type="text" name="fullname" class="form-control"  placeholder="Enter Patient Name">
																
																
															
														</div>

<div class="form-group">
															<label for="address">
																 Address
															</label>
					<input type="text" name="address" class="form-control"  placeholder="Enter address">
														</div>


<div class="form-group">
															<label for="gender">
																 Gender
															</label>
					<select name="gender" class="form-control" id="gender" required="required">
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="Undisclosed">Undisclosed</option>
						</select>
														</div>
<div class="form-group">
															<label for="email">
																email
															</label>
					<input type="email" name="email" class="form-control"  placeholder="Enter Patient Email">
														</div>
	
<div class="form-group">
									<label for="date">
																 regDate
															</label>
					<input type="date" name="date" class="form-control"  placeholder="Enter the Date">
														</div>

														<div class="form-group">
														<label for="age">
																 Age
															</label>
														<input type="text" name="age" class="form-control"  placeholder="Enter Patient Age">
														</div>

														<div class="form-group">
														<label for="status">
																 Patient Status
															</label>
														<select name="status" class="form-control" id="status" required="required">
															<option value="status">Student</option>
															<option value="status">Non Student</option>
														</select>
														</div>

														
														<div class="form-group">
															<label for="exampleInputPassword1">
																 Password
															</label>
					<input type="password" name="password" class="form-control"  placeholder="New Password" required="required">
														</div>
														
<div class="form-group">
															<label for="exampleInputPassword2">
																Confirm Password
															</label>
									<input type="password" name="password_again" class="form-control"  placeholder="Confirm Password" required="required">
														</div>
														
														
														<input type="hidden" name="token" value="<?php echo Token::generate();?>">
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Submit
														</button>
													</form>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									<div class="col-lg-12 col-md-12">
											<div class="panel panel-white">
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>