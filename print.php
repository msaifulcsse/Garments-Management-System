<?php
session_start();
if (!isset($_SESSION["employee"])) {
	header('Location: index.php');
	exit;
}
    require_once('mysql_conn.php');

	$sql1 = "SELECT * FROM employee";
	$result1 = mysql_query($sql1);
	while($row = mysql_fetch_array($result1))
	{
		$e_id= $row['e_id'];
		if($_SESSION["employee"] == $e_id)
		{
			$getEID = $row['e_id'];
			$getName = $row['name'];
			$getDept = $row['dept'];
			$getSal = $row['salary'];
			$getPhn = $row['phone'];
			$getGen = $row['gender'];
			$getDOB = $row['dob'];
			$getAdrs = $row['address'];
			
			//////////////////////////
			
			$month = date("m");
			$sql = "SELECT * FROM salary where month = '$month'";
			$result = mysql_query($sql);
			$nn = mysql_num_rows($result);
			 if($nn != 0)
			   {
				while($row1 = mysql_fetch_array($result))
				 {
             $e_id= $row1['e_id'];
				 if($_SESSION["employee"] == $e_id)
					 {
						$getPsal= $row1['p_salary'];
						$getAbs= $row1['absentDays'];
					 }
   
				 }
			   }
			
	      require ("fpdf/fpdf.php");
          $pdf = new FPDF();

          $pdf->AddPage();
	
	      $pdf->SetFont("Arial","B",10);
	      $pdf->Cell(190,10,"Employee Information",1,1,"C");
	
	      $pdf->Cell(95,10,"Employee ID: ",1,0,"C");
	      $pdf->Cell(95,10,$getEID,1,1,"C");
	
	      $pdf->Cell(95,10,"Employee Name: ",1,0,"C");
	      $pdf->Cell(95,10,$getName,1,1,"C");
	
	      $pdf->Cell(95,10,"Department: ",1,0,"C");
	      $pdf->Cell(95,10,$getDept,1,1,"C");
	
	      $pdf->Cell(95,10,"Phone No.: ",1,0,"C");
	      $pdf->Cell(95,10,$getPhn,1,1,"C");
	
	      $pdf->Cell(95,10,"Gender: ",1,0,"C");
	      $pdf->Cell(95,10,$getGen,1,1,"C");
	
	      $pdf->Cell(95,10,"Date-Of-Birth: ",1,0,"C");
	      $pdf->Cell(95,10,$getDOB,1,1,"C");
	
	      $pdf->Cell(95,10,"Address: ",1,0,"C");
	      $pdf->Cell(95,10,$getAdrs,1,1,"C");
	
	      $pdf->Cell(95,10,"Monthly Salary: ",1,0,"C");
	      $pdf->Cell(95,10,$getSal,1,1,"C");
		  
		  $pdf->Cell(95,10,"Total Absence: ",1,0,"C");
		  $pdf->Cell(95,10,$getAbs,1,1,"C");
		  
		  $pdf->Cell(95,10,"Payable Salary: ",1,0,"C");
		  $pdf->Cell(95,10,$getPsal,1,1,"C");
          $pdf->Output();
         
		}
		
    }
?>