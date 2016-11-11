<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$sql ="SELECT * FROM employee";
$result = mysql_query($sql);
$sql1 ="SELECT * FROM department";
$result1 = mysql_query($sql1);
?>

<html>
<head><title>Information of Salary</title></head>
 <center>
     <h1>Salary Information</h1>
     <hr>
     
<form action="salary1.php" method="POST">
  <table>
    <tr>
    <th>Select Department: </th> 
    <td><select name="dtype">
				<?php
				while ($row1 =  mysql_fetch_assoc($result1)) 
				{
					echo '<option value="'.$row1['dept_name'].'">'.$row1['dept_name'].'</option>';
				}
				?>
			</select>
			</td>
	</tr>
	<tr>
	<th>Select Month: </th>
	<td><select name="month">
					<option>January</option>
					<option>February</option>
					<option selected>March</option>
					<option>April</option>
					<option>May</option>
					<option>June</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November</option>
					<option>December</option>
				</select>
    </td>
    </tr>
<tr>
    <th> </th>
    <td><input type="submit" name="submit" value="Search" /></td>
</tr>
  </table>
</form>
<br>
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>