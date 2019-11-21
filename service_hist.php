<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$user=$_SESSION['id'];
if(isset($_REQUEST['edit']))
    {
	$a = $_POST['reqst_id']; 	
	$d = $_POST['loc'];	
	$e = $_POST['ward'];	
	$f = $_POST['date'];	
	$g = $_POST['ser_reqst'];	
	$h = $_POST['tf'];	
	$query = "Update  tbl_service_rqst SET u_location='$d',u_ward='$e',date='$f',detail='$g',token_fee='$h' WHERE reqst_id='$a'";
$res = mysql_query($query);
			     if($res>0)
		{
			echo '<script language="javascript">';
				echo 'alert("Successfully edited service request ");location.href="service_hist.php"';
                echo '</script>';
		}
			else 
			{
				echo '<script language="javascript">';
				echo 'alert("Something went wrong, try again later...");location.href="service_hist.php"';
                echo '</script>';
			}
	}
if(isset($_REQUEST['delete']))
    {
		$b = $_POST['reqst_id1'];	
$query1 = "DELETE FROM tbl_service_rqst WHERE reqst_id='$b'";
$res1 = mysql_query($query1);
			     if($res1>0)
		{
			echo '<script language="javascript">';
				echo 'alert("Successfully Deleted");location.href="service_hist.php"';
                echo '</script>';
		}
			else 
			{
				echo '<script language="javascript">';
				echo 'alert("Something went wrong, try again later...");location.href="service_hist.php"';
                echo '</script>';
			}
	}








?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User | Service History </title>
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
									<h1 class="mainTitle">User  | Service History</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User </span>
									</li>
									<li class="active">
										<span>Service History</span>
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
													<th>Date</th>
                                                    <th>Details</th>
													<th>Status</th>
												
											</tr>
										</thead>
										<tbody>
<?php
$sql=mysql_query("select * from tbl_service_rqst INNER JOIN tbl_location ON tbl_service_rqst.u_location=tbl_location.loc_id INNER JOIN tbl_ward ON tbl_service_rqst.u_ward=tbl_ward.ward_id  where user_id='$user'");
$i=1;
while($row=mysql_fetch_array($sql))
{
	$i++;
?>

									<tr>
											<td><?php echo $i++;?></td>			
									        <td><?php echo $row['date'];?></td>
											<td><?php echo $row['detail'];?></td>
											<td><?php if($row['status']==0){ echo 'Waiting';?> 
										<div class="btn-group">
		                                 <button type="button" class="btn btn-info btn-flat">Action</button>
	                         <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									<li><a data-toggle="modal" data-target="#edit-<?=$row['reqst_id']?>" href="#"><i class="fa fa-trash-o">Edit</i></a></li>
									<li><a data-toggle="modal" data-target="#delete-<?=$row['reqst_id']?>" href="#"><i class="fa fa-trash-o">Delete</i></a></li>
									  </ul> 
									  </div> <?php } else if($row['status']==1){ echo 'Approved';}?> </td>	
<div class="modal fade" id="edit-<?=$row['reqst_id']?>" role="dialog" >
     <div class="modal-dialog modal-lg">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Service</h4>
      </div>
         <div class="modal-body">
		  <br>
		 
		 <br>
		  <form class="form-horizontal" method="post" name="myForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm(<?php echo $i;?>);">
		 <input type="hidden" class="form-control"  value="<?php echo $row['reqst_id'];?>"  name="reqst_id"> 	 
		 <div class="box-content">
				 <div class="col-md-10 col-md-offset-1">
					<div class="form-group">
					<input type="hidden" class="form-control" name="curdate" value="<?php echo date('Y-m-d'); ?>" required>
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><h4>Location</h4></label>
								<select type="text" class="form-control" name="loc" placeholder="Location" onChange="getWard(this.value)" required>
							<option value="<?php echo $row['loc_id'];?>"><?php echo $row['location_name'];?></option>
							<?php
							$result1=mysql_query("select * from tbl_location");
									  while($row1= mysql_fetch_array($result1))
 									   {
										   ?>
							<option value="<?php echo $row1['loc_id'];?>"><?php echo $row1['location_name'];?></option>
							<?php
									   }
									   ?>
							</select>
							</div>	
				<div class="form-group" >
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><h4>Ward</h4></label>
								<select type="text" class="form-control" id="ward" name="ward" placeholder="Ward" required>
							<option value="<?php echo $row['ward_id'];?>"> <?php echo $row['ward_name'];?></option>
							</select>
							</div>	
				  <div class="form-group">
						 	<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><h4>Date</h4></label>
								<input type="date" class="form-control" name="date" placeholder="Date" value="<?php echo $row['date']; ?>" required>
							</div>
							
							<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><h4>Details</h4></label>
								<textarea type="text" class="form-control" name="ser_reqst" placeholder="Service Request" required><?php echo $row['detail'];?></textarea>
							</div>		
                  <div class="form-group">
				  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><h4>Token</h4></label>
								<input type="text" class="form-control" name="tf" placeholder="Token fee" value="<?php echo $row['token_fee']; ?>" required>
							</div>	
						<br>
									</div>
<button name="edit" type="submit" class="btn btn-success" ><span class="glyphicon 
		glyphicon-ok-sign"></span>Submit</button>
	<button type="reset" class="btn btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
								</div> 
</div>								
      </div>
      
	  </form>
	     <div class="modal-footer ">
        
      </div> 
        </div>
    <!-- /.modal-content --> 
  </div>
									
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
<script type="text/javascript">
	
	 </script>		
	<div class="modal fade" id="delete-<?=$row['reqst_id']?>" role="dialog" >
     <div class="modal-dialog modal-lg">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Service Request</h4>
      </div>
         <div class="modal-body">
		  <br>
		 <h3 class="modal-title custom_align" id="Heading" style="margin-left:200px;color:#e85c68">Do You Want delete This request?</h3>
		 <br>
		  <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		 <input type="hidden" class="form-control"  value="<?php echo $row['reqst_id'];?>"  name="reqst_id1"> 	 
		 <div class="box-content">
		
<button name="delete" type="submit" class="btn btn-success" ><span class="glyphicon 
		glyphicon-ok-sign"></span>Submit</button>
	<button type="reset" class="btn btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
								</div> 
</div>								
      </div>
      
	  </form>
	     <div class="modal-footer ">
        
      </div> 
        </div>
    <!-- /.modal-content --> 
  </div>								
						
									
									
									</tr>
											
					<?php 
                          }
					?>
											
											
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
			<script type="text/javascript">
			 function validateForm()
     {
	 var a=document.forms["myForm"]["date"].value;
	 alert(a);
	var b=document.forms["myForm"]["curdate"].value;
	var m=a.toString();
	var n=b.toString();
	if(n>m)
	{
		alert("Service Booking date incorrect");
		return false;
	}
	 </script>
				
			
			
			
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
