<?php
session_start();
include_once('include/config.php');
include('include/checklogin.php');
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$address=$_POST['address'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$contact_no=$_POST['contact_no'];
$mail=$_POST['mail'];
$patient_detail=$_POST['patient_detail'];
$medical_detail=$_POST['medical_detail'];
$required_service=$_POST['required_service'];
     
		/*$allowedExts = array("gif","jpeg","jpg","png","JPG");
		$temp = explode(".",$_FILES["file"]["name"]);
		$extension = end($temp);
	
						if ((($_FILES["file"]["type"] == "image/gif")
						|| ($_FILES["file"]["type"] == "image/jpeg")
					    || ($_FILES["file"]["type"] == "image/JPEG")
						|| ($_FILES["file"]["type"] == "image/JPG")
						|| ($_FILES["file"]["type"] == "image/pjpeg")
						|| ($_FILES["file"]["type"] == "image/pjpeg")
						|| ($_FILES["file"]["type"] == "image/x-png")
						|| ($_FILES["file"]["type"] == "image/png"))
						&& ($_FILES["file"]["size"] > 2000)
						&& in_array($extension, $allowedExts))
						{
							
								if ($_FILES["file"]["error"] > 0)
								{
									
									echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
								} 
									else
								{
		
									$image_name=$_FILES['file']['name'];
					
                        	   }
						}*/
					
 $query="UPDATE `tbl_user` SET u_name='$name', u_address='$address', u_dob='$dob', u_gender='$gender', u_contact_no='$contact_no', u_mail_id='$mail', u_patient_detail='$patient_detail', u_medical_detail='$medical_detail', u_required_service='$required_service' where log_id='".$_SESSION['id']."'" ;

$exe2=mysql_query($query);
 				
 //move_uploaded_file($_FILES["file"]["tmp_name"],"../images/" . $image_name );
 if($exe2>0)
		{
			echo '<script language="javascript">';
				echo 'alert("Successfully Updated");location.href="edit-profile.php"';
                echo '</script>';
		}
			else 
			{
				echo '<script language="javascript">';
				echo 'alert("Something went wrong, try again later...");location.href="edit-profile.php"';
                echo '</script>';
			}

		
		
			}
?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Update User Registration</title>
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
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		
</head>
<body class="login">
		<!-- start: REGISTRATION -->
				<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User | Update Profile</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
								
									<li class="active">
										<span>My Profile</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2">
			
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					
									<?php 
						/*"select tbl_user.*,tbl_unit.* from tbl_staff INNER JOIN tbl_unit ON tbl_staff.unit=tbl_unit.unit_id where tbl_staff.log_id='$user'");*/	
         $sql=mysql_query("select * from tbl_user INNER JOIN tbl_class ON tbl_user.u_class=tbl_class.class_id where log_id='".$_SESSION['id']."'");
						while($data=mysql_fetch_array($sql))
               {  
		   $gen= $data['u_gender'];
   ?>
					<form  id="registration"  method="post" name="myForm" onsubmit="return validateForm();"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
						<fieldset>
							<legend>
							Update Profile
							</legend>
							<p>
								Enter your personal details below:
							</p>
							<div class="form-group">
								<label for="fname">
																 Full Name
															</label>
								<input type="text" class="form-control" name="name" placeholder="Full Name" value="<?php echo htmlentities($data['u_name']);?>" required>
							</div>
							<div class="form-group">
									<label for="Address">
														Address	
															</label>
								<textarea type="text" class="form-control" name="address" placeholder="Address" required><?php echo htmlentities($data['u_address']);?></textarea>
							</div>
							<div class="form-group">
										<label for="Date of Birth">
														Date of Birth	
															</label>
								<input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo htmlentities($data['u_dob']);?>"required>
							</div>
							<div class="form-group">
								<label class="block">
									Gender
								</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="gender" value="female" <?php echo ($gen=="female") ? "checked" : " ";?>>
									<label for="rg-female">
										Female
									</label>
									<input type="radio" id="rg-male" name="gender" value="male"  <?php echo ($gen=="male") ? "checked" : " ";?>>
									<label for="rg-male">
										Male
									</label>
								</div>
							</div>
							
								<div class="form-group">
								<label for="Contact No">
														Contact No	
															</label>
								<input type="text" class="form-control" name="contact_no" placeholder="Contact No" value="<?php echo htmlentities($data['u_contact_no']);?>" required>
							</div>
							
								<div class="form-group">
									<label for="Email">
														Email	
															</label>
								<input type="email" class="form-control" name="mail" placeholder="Email" value="<?php echo htmlentities($data['u_mail_id']);?>" required>
							</div>
							
					<!----<div class="form-group">
						<label for="ration_copy">
														Ration copy	
															</label>
				
				<input type="file" class="form-control" name="file" placeholder="ration_copy" value="<?php //echo $data['u_ration_copy'];?>" required>
				<img src="<?php //echo ("../images/");if($data['u_ration_copy']) //echo $data['u_ration_copy']; else echo "no-img.jpg"; ?>"  alt="" height="50" width="50" style="margin-right:450px;"/>
					</div>---->
							
		
							
								<div class="form-group">
									<label for="Patient Details">
														Patient Details	
															</label>
								<textarea type="text" class="form-control" name="patient_detail" placeholder="Patient Details" required><?php echo htmlentities($data['u_patient_detail']);?> </textarea>
							</div>
								<div class="form-group">
								<label for="Medical_Details">
												Medical Details		
															</label>
								<textarea type="text" class="form-control" name="medical_detail" placeholder="Medical_Details" required><?php echo htmlentities($data['u_medical_detail']);?></textarea>
							</div>
							
							
								<div class="form-group">
								<label for="Required Service">
												Required Service		
															</label>
								<textarea type="text" class="form-control" name="required_service" placeholder="Required Service" required><?php echo htmlentities($data['u_required_service']);?></textarea>
							</div>
<?php } ?>	
						<div class="form-actions">
							
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Update <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>


				</div>

			</div>
		</div>
				<!-- start: FOOTER -->			
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->

			<>
			<!-- end: SETTINGS -->
		</div>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	
	<script type="text/javascript">
			 function validateForm()
     {
	 var x=document.forms["myForm"]["name"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Name should be Aphabet");
             return false;
     }
	 var x=document.forms["myForm"]["address"].value;
	 var letters = /^[0-9 a-z A-Z]+$/;
     if(!x.match(letters))
     {
             alert("Field should not Null");
             return false;
     }
     var x=document.forms["myForm"]["patient_detail"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Qualification should be Aphabet");
             return false;
     }
    var x=document.forms["myForm"]["mail"].value
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if(atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
      {
      alert("Not a valid e-mail address");
      return false;
      }
	var x=document.forms["myForm"]["medical_detail"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Medical details should be Aphabet");
             return false;
     }
	   var x=document.forms["myForm"]["required_service"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Required Service should be Aphabet");
             return false;
     }
	  
	  var x=document.forms["myForm"]["contact_no"].value;
     var letters=/^\d{10}$/;
	if(!x.match(letters))
	{
		alert("please Add 10 Digit phone number");
		document.forms["myForm"]["contact_no"].focus();
		return false;
	}
	
	 var x=document.forms["myForm"]["aadhar"].value;
	 var letters = /^[0-9]+$/;
     if(!x.match(letters))
     {
             alert("Aadhar should Be Numeric");
             return false;
     }
	 }
	 </script>	
	</body>
	<!-- end: BODY -->
</html>