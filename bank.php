<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$id=$_SESSION['id'];
if(isset($_REQUEST['bank']))
    {
        $acno = $_POST['acno'];
		$cardno = $_POST['cardno'];
		$cvv = $_POST['cvv'];
		$exyear = $_POST['exyear'];
		$exmonth = $_POST['exmonth'];
		$cardtype = $_POST['cardtype'];
		$holder = $_POST['holder'];
		$bank = $_POST['bank'];
		$amount = $_POST['amount'];
		if($_POST['id'])
		{
        $query = "UPDATE bank set cardno='$cardno',cvv='$cvv',exmonth='$exmonth',exyear='$exyear',Cardtype='$cardtype',holdername='$holder',Bankname='$bank',balance='$amount' where bank_loginid='$login_id'";    
		}
		else
		{
			$query = "INSERT INTO bank(Accountno,cardno,cvv,exmonth,exyear,Cardtype,holdername,Bankname,balance,bank_loginid) VALUES ('$acno','$cardno','$cvv','$exmonth','$exyear','$cardtype','$holder','$bank','$amount','$login_id')";
		}
         $res = mysql_query($query);
			     if($res>0)
		{
			echo '<script language="javascript">';
				echo 'alert("Successfully Add Bank Details");location.href="bank.php"';
                echo '</script>';
		}
			else 
			{
				echo '<script language="javascript">';
				echo 'alert("Something went wrong, try again later...");location.href="bank.php"';
                echo '</script>';
			}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Add Bank Details</title>
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
									<h1 class="mainTitle">User | Add  Bank Details</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Book Bank Details</span>
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
				
							</legend>
							<p>
								Enter your details below:
							</p>
				
			<?php
		  $query1 = "SELECT * FROM `bank` where bank_loginid='$login_id'";
          $res1 = mysql_query($query1);
		  if(mysql_num_rows($res1)>0)
		  {
		while($row = mysql_fetch_array($res1))
       {
		  
		?>	  <input type="hidden" class="form-control" name="id" value="<?php echo $row['Accountno']?>" required/>
             <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Account No</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" Placeholder="Enter Account Number" value="<?php echo $row['Accountno']?>" name="acno"  />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Card No</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" name="cardno" value="<?php echo $row['cardno']?>" Placeholder="Enter Card Number"  />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">CVV</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" name="cvv"  value="<?php echo $row['cvv']?>"  />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Expiry Month</label>

										<div class="">
											 <select name="exmonth" id="form-field-1" class="col-xs-10 col-sm-7">
			 <option value="<?php echo $row['exmonth']?>"><?php echo $row['exmonth']?></option>
			 <option value="January">January</option>
			 <option value="February">February</option>
			 <option value="March">March</option>
			 <option value="April">April</option>
			 <option value="May">May</option>
			 <option value="June">June</option>
			 <option value="July">July</option>
			 <option value="August">August</option>
			 <option value="October">October</option>
			 <option value="November">November</option>
			 <option value="December">December</option>
			 </select>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Expiry Year</label>

										<div class="">
											  <select id="form-field-1" class="col-xs-10 col-sm-7" name="exyear">
			  <option value="<?php echo $row['exyear']?>"><?php echo $row['exyear']?></option>
			  <?php
			  for($i=2018;$i<2050;$i++)
			  { 
			  ?>
			 <option value="<?php echo $i;?>"><?php echo $i;?></option>
		      <?php
			  }
			  ?>
			 </select>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Card Type</label>

										<div class="">
											 <select id="form-field-1" class="col-xs-10 col-sm-7"  name="cardtype" required>
			 <option value="<?php echo $row['Cardtype']?>"><?php echo $row['Cardtype']?></option>
			 <option value="Debit">Debit</option>
			 <option value="Credit">Credit</option>
			
			 </select>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Holder Name</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" value="<?php echo $row['holdername']?>" name="holder" placeholder="Enter Holder Name"  />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Name</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7"name="bank" placeholder="Enter Bank Name" value="<?php echo $row['Bankname']?>" />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Enter Amount</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" name="amount" placeholder="Enter Amount" value="<?php echo $row['balance']?>"/>
										</div>
									</div>
			<?php
	         }
		  }
		  else
		  {
			  ?>
			   <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Account No</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" Placeholder="Enter Account Number"  name="acno"  />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Card No</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" name="cardno" Placeholder="Enter Card Number"  />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">CVV</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" Placeholder="Enter CVV Number" name="cvv"/>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Expiry Month</label>

										<div class="">
											 <select name="exmonth" id="form-field-1" class="col-xs-10 col-sm-7">
			 <option value="">--Select--</option>
			 <option value="January">January</option>
			 <option value="February">February</option>
			 <option value="March">March</option>
			 <option value="April">April</option>
			 <option value="May">May</option>
			 <option value="June">June</option>
			 <option value="July">July</option>
			 <option value="August">August</option>
			 <option value="October">October</option>
			 <option value="November">November</option>
			 <option value="December">December</option>
			 </select>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Expiry Year</label>

										<div class="">
											  <select id="form-field-1" class="col-xs-10 col-sm-7" name="exyear" class="form-control" required>
			  <option value="">--Select--</option>
			  <?php
			  for($i=2018;$i<2050;$i++)
			  { 
			  ?>
			 <option value="<?php echo $i;?>"><?php echo $i;?></option>
		      <?php
			  }
			  ?>
			 </select>
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Card Type</label>
<div class="">
										 <select  id="form-field-1" class="col-xs-10 col-sm-7"  name="cardtype" required>
			 <option value="">--Select--</option>
			 <option value="Debit">Debit</option>
			 <option value="Credit">Credit</option>
			
			 </select>
											
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Holder Name</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" value="" name="holder" placeholder="Enter Holder Name"  />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Bank Name</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7"name="bank" placeholder="Enter Bank Name" value="" />
										</div>
									</div>
									 <div class="form-group">
										<label class="control-label no-padding-right" for="form-field-1">Enter Amount</label>

										<div class="">
											<input type="text" id="form-field-1" class="col-xs-10 col-sm-7" name="amount" placeholder="Enter Amount" value=""/>
										</div>
									</div>
			<?php
		  }
	         ?>
			</div>
        							<div class="clearfix form-actions">
										
										<div class="col-md-offset-4 col-md-8">
											<button class="btn btn-info" name="submit" type="submit" value="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp;&nbsp; &nbsp;	&nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
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
	 var x=document.forms["myForm"]["holder"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Holder name should be Aphabet");
             return false;
     }
	 var x=document.forms["myForm"]["bank"].value;
	 var letters = /^[A-Z a-z ]+$/;
     if(!x.match(letters))
     {
             alert("Holder name should be Aphabet");
             return false;
     }
	  var x=document.forms["myForm"]["cvv"].value;
     var letters=/^\d{3}$/;
	if(!x.match(letters))
	{
		alert("please Add 3 Digit cvv number");
		document.forms["myForm"]["cvv"].focus();
		return false;
	}
	var x=document.forms["myForm"]["cardno"].value;
     var letters=/^\d{16}$/;
	if(!x.match(letters))
	{
		alert("please Add 16 Digit card number");
		document.forms["myForm"]["cardno"].focus();
		return false;
	}
	var x=document.forms["myForm"]["acno"].value;
     var letters=/^\d{11}$/;
	if(!x.match(letters))
	{
		alert("please Add 11 Digit account number");
		document.forms["myForm"]["acno"].focus();
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
