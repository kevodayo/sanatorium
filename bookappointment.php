<?php
require_once 'core/init.php';

$db = Db::getInstance();
$message = "";
if(isset($_POST['submit']))
{	

	$res = $db->getPDO();
	$sql=$res->prepare("select Patient.fullname as name,appointment.*  from appointment join Patient on Patient.fullname= ?");
	$sql->execute([$_SESSION['username']]);
	//$count = 1;
	$row=$sql->fetch(PDO::FETCH_ASSOC);
	$_SESSION['username'] = $row['name'];
		
		// if($row['status']==0){
		// 	$specilization=$_POST['Doctorspecialization'];
		// 	 $doctorid=$_POST['doctor'];
		// 	$userid=$_POST['userid'];
		// 	// $fees=$_POST['fees'];
		// 	$appdate=$_POST['appdate'];
		// 	$time=$_POST['apptime'];
		// 	$userstatus=1;
		// 	$docstatus=1;

		// 	$query=$db->insert('appointment',array('doctorspecialization'=>$specilization,
		// 						 'doctorname'=>$doctorid,
		// 						'patientid'=>$userid,
		// 						 'consultancyfee'=>$fees,
		// 						'appointmentdate'=>$appdate,
		// 						'appointmenttime'=>$time,
		// 						'patientstatus'=>$userstatus,
		// 						'doctorstatus'=>$docstatus));
		// 	echo "<script>window.open('dashbord.php','_self')</script>";
		// }else{

			$specilization=$_POST['Doctorspecialization'];
			 $doctorid=$_POST['doctor'];
			 $username=$_SESSION['username'];
			$fees=$_POST['fees'];
			$appdate=$_POST['appdate'];
			$time=$_POST['apptime'];
			$userstatus=1;
			$docstatus=1;

			$sql=$res->prepare("SELECT * FROM appointment WHERE doctorname = ? AND appointmentdate = ? AND appointmenttime = ?");
			$sql->execute([$doctorid,$appdate,$time]);
			if($sql->fetch(PDO::FETCH_ASSOC)){
               $message = "Doctor not available a that time !";
            }else{
			//$sql = "SELECT * FROM appointment WHERE doctorname = $doctorid AND appointmentdate = $appdate AND appointmenttime = $apptime"


			$query=$db->insert('appointment',array('doctorspecialization'=>$specilization,
								 'doctorname'=>$doctorid,
								 'patient_name'=>$username,
								'consultancyfee'=>$fees,
								'appointmentdate'=>$appdate,
								'appointmenttime'=>$time,
								'patientstatus'=>$userstatus,
								'doctorstatus'=>$docstatus));
// $query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
	if($query)
	{
		echo "<script>alert('Your appointment successfully booked');</script>";
	}
		
	//}
   }

}
// if(isset($_POST['signout'])){

// 	$res = $db->getPDO();
// 	$sql=$res->prepare("select Patient.fullname as name,appointment.*  from appointment join Patient on Patient.id= ?");
// 	$sql->execute([$_POST['userid']]);
// 	$count = 1;
// 	while($row=$sql->fetch(PDO::FETCH_ASSOC)){
// 		// if(($row['consultancyfee']==0) && ($row['studentstatus']==0))  
// 		// {
// 		// 	echo "Active";
// 		// }
// 		if(($row['consultancyfee']>0) && ($row['studentstatus']==0)){
// 			echo 'inactive';
// 		}else{
// 			echo 'logged out';
// 		}
// 	}
// }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Book Appointment</title>
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
		<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "getDoctor.php",
	data:'specialization='+val,
	success: function(data){
		$("#doctor").html(data);
		//alert(data);
	}
	});
}
</script>	


<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "getDoctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
		//alert(data);
	}
	});
}
</script>	




	</head>
	<body>
		<div id="app">		

			<?php include('include/sidebar.php');?>
			<div class="app-content">
			
						<?php include('include/header.php');?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Patient | Book Appointment</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Patient</span>
									</li>
									<li class="active">
										<span>Book Appointment</span>
									</li>
								</ol>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<?php 
                                               if($message != ""){
                                               	  echo "<p class='text-danger'>".$message."</p>";
                                               }
                                                   
											?>
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Book Appointment</h5>
												</div>
												<div class="panel-body">
								<p style="color:red;"><!-- <?php //echo htmlentities($_SESSION['msg1']);?>
								<?php //echo htmlentities($_SESSION['msg1']="");?> --></p>	
													<form role="form" name="book" method="post" >
														


											<div class="form-group">
															<label for="DoctorSpecialization">
																Doctor Specialization
															</label>
															<select name="Doctorspecialization" required="required" class="form-control" onChange="getdoctor(this.value);" >
																<option value="">Select Specialization</option>
																	<?php 
																	//$ret=mysqli_query($con,"select * from doctorspecilization");
																	$ret = $db->query('select DISTINCT specialization from doctor');
																	if(!$ret->count()){
																		echo 'No user';
																	}else{
																		foreach ($ret->results() as $user) {
																			# code...
																			//echo $user-> specialization.'<br>';
																		//}
																	//}
																	// while($row=mysqli_fetch_array($ret))
																	// {
																	?>
																<option value="<?php echo htmlentities($user-> specialization);?>">
																	<?php echo htmlentities($user-> specialization);?>
																</option>
																<?php  }}?>
																
															</select>
														</div>




														<div class="form-group">
															<label for="doctor">
																Doctors
															</label>
						<select name="doctor" class="form-control" id="doctor" onchange="getfee(this.value);" required="required" >
						<option value="doctor">Select Doctor</option>
						</select>
														</div>


													<div class="form-group">
															<label for="consultancyfees">
																Consultancy fees
															</label>
						<select name="fees" class="form-control" id="fees" readonly>
						</select>
														</div>


														
<div class="form-group">
															<label for="AppointmentDate">
																Date
															</label>
<input class="form-control datepicker" name="appdate" required="required"  data-date-format="yyyy-mm-dd">
	
														</div>
														
<div class="form-group">
															<label for="Appointmenttime">
														
														Time
													
															</label>
			<input class="form-control" name="apptime" required="required" id="timepicker1" >eg : 10:00 PM
														</div>														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Submit
														</button>
														<a href="dashbord.php"><button type="submit" name="signout" id="signout" class="btn btn-o btn-primary">
															Back
														</button></a>
													</form>
												</div>
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

			$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '+0d'
});
		</script>
		  <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>


	</body>
</html>