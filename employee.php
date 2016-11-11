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
		}
		
	}
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
 else
 {
  $getPsal= 0;
  $getAbs= 0;
 }
	
?>

<html>
<head><title>Employee Details</title></head>
<center>
<h1>Employee Information</h1>
<hr>
<table border="1">
   <tr>
      <th>Your ID: </th>
	  <td>
	     <?php
		   echo $getEID;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Name: </th>
	  <td>
	     <?php
		   echo $getName;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Department: </th>
	  <td>
	     <?php
		   echo $getDept;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Phone: </th>
	  <td>
	     <?php
		   echo $getPhn;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Gender: </th>
	  <td>
	     <?php
		   echo $getGen;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Date-Of-Birth: </th>
	  <td>
	     <?php
		   echo $getDOB;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Address: </th>
	  <td>
	     <?php
		   echo $getAdrs;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Last Months Absence: </th>
	  <td><?php
		   echo $getAbs;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Your Monthly Salary: </th>
	  <td><?php
		   echo $getSal;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Payable Salary: </th>
	  <td><?php
		   echo $getPsal;
		 ?>
	  </td>
   </tr>

</table>

<a href="print.php"><h3>Print Your Info</h3></a>
<a href="logout.php"><h2>Logout</h2></a>
</center>

</html>