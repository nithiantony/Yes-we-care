<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=$_SESSION['id'];
$query1="SELECT * FROM tbl_location";
$result1 = mysql_query($query1);
if(isset($_POST['submit']))
{
$loc=$_POST['loc'];
$ward=$_POST['ward'];
$date=$_POST['date'];
$rqst=$_POST['ser_reqst'];
$tf=$_POST['tf'];
$query1 = "SELECT * FROM `bank` where bank_loginid='$login_id'";
$res1 = mysql_query($query1);
if(mysql_num_rows($res1)>0)
{
$result1 = mysql_result($res1,0,'balance');
if($amt>$result1)
{
	echo '<script language="javascript">';
	echo 'alert("Insufficient Account Balance");location.href="service_request.php"';
    echo '</script>';	
}
else
{
$query3 = "SELECT * FROM `tbl_login` where role='1'"; 
$res3 = mysql_query($query3);
$result3 = mysql_result($res3,0,'user_id');	
$query2 = "SELECT * FROM `bank` where bank_loginid='$result3'";
$res2 = mysql_query($query2);
if(mysql_num_rows($res2)==0)
{
	echo '<script language="javascript">';
	echo 'alert("No Account Is Created By The Admin");location.href="service_request.php"';
    echo '</script>';	
}
$query4=mysql_query("UPDATE bank SET balance = balance - '$tf' where bank_loginid='$login_id'");
$query5=mysql_query("UPDATE bank SET balance = balance + '$tf' where bank_loginid='$result3'");
	 
$sql2="INSERT INTO `tbl_service_rqst` (`user_id`, `u_location`, `u_ward`, `date`, `detail`,`status`) VALUES('$id','$loc','$ward','$date','$rqst','0')";
$exe1=mysql_query($sql2); 
$id = mysql_insert_id();
 
$sql1="INSERT INTO `tbl_service_fee`(`rqst_id2`, `amt`, `date`) VALUES('$id','$tf',curdate())";
 $exe2=mysql_query($sql1); 
	
	 if($exe1>0)
		{
			echo '<script language="javascript">';
				echo 'alert("Service Registered Successfully. You waiting for approvel");location.href="service_hist.php"';
                echo '</script>';
		}
			else 
			{
				echo '<script language="javascript">';
				echo 'alert("Something went wrong, try again later...");location.href="service_request.php"';
                echo '</script>';
			}
	
}
}
else
{
	echo '<script language="javascript">';
	echo 'alert("Please Add Bank Account Details");location.href="add_charity.php"';
    echo '</script>';	
}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Book Service</title>
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


	</head>
	<body>
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
									<h1 class="mainTitle">User | Book Service</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Book Service</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						
				<div class="container-fluid container-fullw bg-white">
					
							<div class="row">		
						<div class="col-sm-5 col-md-offset-3">
				
				
				<form class="form-horizontal" method="post" name="myForm" action="" onsubmit="return validateForm();" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
						<fieldset>
							<legend>
							Service Request
							</legend>
							<p>
								Enter your details below:
							</p>
				
			<input type="hidden" class="form-control" name="curdate" value="<?php echo date('Y-m-d'); ?>" required>
				         <?php $sql=mysql_query("select * from tbl_user where log_id='".$_SESSION['id']."'");
						while($data=mysql_fetch_array($sql))
{
?>
				<input type="hidden" class="form-control" name="id" placeholder="user id" value="<?php echo $data['users_id']?>">
							<div class="form-group">
								<select type="text" class="form-control" name="loc" placeholder="Location" onChange="getWard(this.value)" required>
							<option>--Select Location--</option>
							<?php
									  while($row1 = mysql_fetch_array($result1))
 									   {
										   ?>
							
							<option value="<?php echo $row1['loc_id'];?>"><?php echo $row1['location_name'];?></option>
							
							<?php
									   }
									   ?>
							</select>
							</div>	
				<div class="form-group" >
								<select type="text" class="form-control" id="ward" name="ward" placeholder="Ward" required>
							<option value="">--Select Ward--</option>
							</select>
							</div>	
				        <div class="form-group">
								<input type="date" class="form-control" name="date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" required>
							</div>
							<div class="form-group">
								<textarea type="text" class="form-control" name="ser_reqst" placeholder="Service Request" required></textarea>
							</div>		
                    <?php } ?>
						<div class="form-group">
								<input type="text" class="form-control" name="tf" placeholder="Token fee" value="<?php echo 100;?>" readonly>
							</div>
							<div class="form-actions">
							<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
						
						</div>
						
							</div>
				</div>
						
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
	<script type="text/javascript">
	 function validateForm()
     {
	var a=document.forms["myForm"]["date"].value;
	var b=document.forms["myForm"]["curdate"].value;
	var m=a.toString();
    var n=b.toString();
	if(m<=n)
	{
		alert("Service Booking date incorrect");
		return false;
	}
	 }
	 </script>
<script type="text/javascript">
	function getWard(str){
		//var dept = $('.dept').val();
		if (str == "") {
        document.getElementById("ward").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ward").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","find_ward.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>	 
		<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->

			<>
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
