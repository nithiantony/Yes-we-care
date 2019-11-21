<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$user=$_SESSION['id']; //echo $user; die(); 
$sql1=mysql_query("SELECT * FROM `tbl_user` WHERE log_id='$user'"); //echo $sql1; die();
while($row1=mysql_fetch_array($sql1))
{
	$usr=$row1['users_id'];  //echo $usr; die(); 
}
 

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User | Doctor's Priscription</title>
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
									<h1 class="mainTitle">User  | Doctor's Priscription</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User </span>
									</li>
									<li class="active">
										<span>Doctor's Priscription </span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
						<div class="row">
								<div class="col-md-12">
							
									<table class="table table-hover" id="sample-table-1">

                                                 <thead>
													<tr>
													
													<th>Sl no</th>
												
													<th>Medicines</th>
													<th>Qty</th>
													<th>Dosage</th>
												    <th>Date</th>
												   </tr>
												   </thead>

												<tbody>
											<?php
$sql=mysql_query("select * from tbl_prescription INNER JOIN tbl_medicine ON tbl_prescription.med_id1=tbl_medicine.med_id 
INNER JOIN  tbl_allot_work ON tbl_prescription.allot_id1=tbl_allot_work.allot_id 
                        INNER JOIN  tbl_service_rqst ON tbl_allot_work.rqst_id=tbl_service_rqst.reqst_id 
                        INNER JOIN  tbl_user ON tbl_service_rqst.user_id=tbl_user.log_id where user_id='$usr'
						
							");

$i=1;
while($row=mysql_fetch_array($sql))
{
?>		
							<tr>
							<td><?php echo $i++;?></td>			
							<td><?php echo $row['med_name']; ?></td>    
						    <td><?php echo $row['qty1']; ?></td> 
						    <td><?php echo $row['dosage'];?></td>
							<td><?php echo $row['date'];?></td>	
						<!----<div class="btn-group">
		<button type="button" class="btn btn-info btn-flat">Action</button>
		
									  <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									<li><a data-toggle="modal" data-target="#approve-<?=$row['users_id']?>" href="priscripit.php"><i class="fa fa-trash-o">Add Priscription</i></a></li>
									<li><a data-toggle="modal" data-target="#reject-<?=$row['_id']?>" href="#"><i class="fa fa-trash-o">Reject</i></a></li>
									  </ul>
									  </div>--->
							      </tr>
																	
							<?php 

								 }?>
						
						</tbody>
			        </table>
	              </div>
							</div>
								</div>
						
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->

			
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
