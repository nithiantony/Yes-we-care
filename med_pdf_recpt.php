
<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
require('fpdf/fpdf.php');
check_login();
$user=$_SESSION['id']; //echo $user; die(); 

$sql1=mysql_query("SELECT * FROM `tbl_user` WHERE log_id='$user'"); //echo $sql1; die();
while($row1=mysql_fetch_array($sql1))
{
	$usr=$row1['users_id'];  //echo $usr; die(); 
}

if(isset($_GET['id']))
   {
   $id = $_GET['id']; //echo $id; die(); 
   $query = "SELECT * FROM tbl_prescription INNER JOIN tbl_bill ON tbl_prescription.allot_id1=tbl_bill.allot_id2 WHERE allot_id2 ='$id'";	//echo $query; die(); 
   $queryrun= mysql_query($query);
   $row = mysql_fetch_array($queryrun);
   }

//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;

//print column titles

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(25);

$pdf->Cell(155, 8, 'Medicine Receipt', 1, 0, 'C', 1);
$pdf->SetY($y_axis_initial);

$pdf->SetX(25);
$pdf->Cell(60, 6, 'Name', 1, 0, 'L', 1);

$pdf->Cell(60, 6, 'Medicine-Quantity', 1, 0, 'L', 1);

$pdf->Cell(35, 6, 'Total Price', 1, 0, 'L', 1);
$row_height = 6;
$y_axis=25;
$y_axis = $y_axis + $row_height;

  //Select the BOOKS you want to show in your PDF file
  $result=mysql_query("select * from tbl_prescription INNER JOIN tbl_medicine ON tbl_prescription.med_id1=tbl_medicine.med_id 
             INNER JOIN  tbl_allot_work ON tbl_prescription.allot_id1=tbl_allot_work.allot_id 
             INNER JOIN  tbl_service_rqst ON tbl_allot_work.rqst_id=tbl_service_rqst.reqst_id 
             INNER JOIN  tbl_user ON tbl_service_rqst.user_id=tbl_user.users_id 
             INNER JOIN  tbl_bill ON tbl_prescription.allot_id1=tbl_bill.allot_id2  where allot_id1='$id'
			 GROUP BY allot_id1
			 ");
//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

while($row = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
        $pdf->Cell(60, 6, 'Name', 1, 0, 'L', 1);	
        $pdf->Cell(60, 6, 'Medicine', 1, 0, 'L', 1);
     
		$pdf->Cell(60, 6, 'Total Price', 1, 0, 'L', 1);
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $pdf->SetY($y_axis);
    $pdf->SetX(25);
    $name=$row['u_name'];
	$pdf->Cell(60, 6, $name, 1, 0, 'L', 1);	
	                                         $a=array();
											 $b=array();
										 $allot_id=$row['allot_id1'];
										 $sql2=mysql_query("select * from tbl_prescription where allot_id1='$allot_id'");
										 while($row1=mysql_fetch_array($sql2)) 
                                           { 
									        array_push($a,$row1['med_id1']);
											array_push($b,$row1['qty1']);
										   }
										   foreach($a as $key=>$value)
										   {
											   $med=$value;
											   $sql3=mysql_query("select * from tbl_medicine where med_id='$med'");
											   $name = mysql_result($sql3,0,'med_name');
											   $qty=$b[$key];
											  $pdf->Cell(60, 6, $name.'-'.$qty , 1, 0, 'L', 1);	
										  
										  }
                 
				 $allot_id=$row['allot_id1'];
				 $sql1=mysql_query("select sum(t_amt) as amt from tbl_bill where allot_id2='$allot_id'");
				 $result1 = mysql_result($sql1,0,'amt');
				
                 $pdf->Cell(35, 6, $result1, 1, 0, 'L', 1);	
	//Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}
//Send file
$pdf->Output();

?>