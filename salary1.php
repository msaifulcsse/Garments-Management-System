<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$dept = $_REQUEST['dtype'];
$sql ="SELECT * FROM employee where dept='$dept'";
$result = mysql_query($sql);
$month = $_REQUEST['month'];
$monthNO;
switch ($month)
{
	case 'January': $monthNO = '01';
	break;
	case 'February': $monthNO = '02';
	break;
	case 'March': $monthNO = '03';
	break;
	case 'April': $monthNO = '04';
	break;
	case 'May': $monthNO = '05';
	break;
	case 'June': $monthNO = '06';
	break;
	case 'July': $monthNO = '07';
	break;
	case 'August': $monthNO = '08';
	break;
	case 'September': $monthNO = '09';
	break;
	case 'October': $monthNO = '10';
	break;
	case 'November': $monthNO = '11';
	break;
	case 'December': $monthNO = '12';
	break;
	
}

?>


<html>
<head><title>Salary Calculation</title></head>
<center>
<h1>Salary Information</h1>
     <hr>
<table border="1" style="width:50%">
	<tr>
		<td>User ID</td>
		<td>Name</td>
		<td>Department</td>
		<td>Salary</td>
		<td>Absent Days</td>
		<td>Payable salary</td>
	
	</tr>
  <?php
	
		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			$var = $row['e_id'];
			echo "<td>".$var."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['dept']."</td>";
			
			$sql2 ="SELECT * FROM `attendance` WHERE e_id='$var' AND attend_date LIKE '%$monthNO%'";	
			$result2 = mysql_query($sql2);
			$attend = mysql_num_rows($result2);
			$sql3 ="SELECT salary FROM `employee` WHERE e_id='$var'";
			$result3 = mysql_query($sql3);
			$salary=  mysql_fetch_array($result3);
			$sal = $salary['salary'];
			$pSalary = ($sal/30)*$attend;
			$abs = 30-$attend;
			echo "<td>".$sal."</td>";
			echo "<td>".$abs."</td>";
			echo "<td>".$pSalary."</td>";
			echo "</tr>";
			
			$sqlinsert = "INSERT INTO `salary`(`e_id`, `month`, `salary`, `p_salary`, `absentDays`) VALUES ('$var','$monthNO','$sal','$pSalary','$abs')";
			if(!mysql_query($sqlinsert))
			{
				echo "Error: " . $sqlinsert . "<br>" . mysql_error($conn);
			}
		}
	echo "</table> \n"; 
	
  ?>
    </table>
    <br>
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>