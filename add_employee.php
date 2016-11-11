<?php
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
	require_once('mysql_conn.php');
	
	$sql ="SELECT * FROM department";
	$result = mysql_query($sql);
?>

<html>
<head><title>For Adding Employee</title></head>
<center>
<h1>New Employee Details</h1>
<hr>

<form action="add_employee1.php" method="post">
  <table>
    <tr>
	   <th>Select Department: </th>
	   <td><select name="dtype">
					<?php
						 while ($row =  mysql_fetch_assoc($result)) {
                         echo '<option value="'.$row['dept_name'].'">'.$row['dept_name'].'</option>';
			            }
					?>
			</select>
		</td>
	</tr>

    <tr>
	   <th>Name: </th>
	   <td><input type="text" name="name"></td>
	</tr>
	<tr>
	   <th>Gender: </th>
	   <td><select name="gender">
					<option>Male</option>
					<option>Female</option>
				</select>
		</td>
	</tr>
	<tr>
	    <th>Date of Birth: </th>
		<td><input type="date" name="date"></td>
	</tr>
	<tr>
	    <th>Phone: </th>
		<td><input type="text" name="phone"></td>
	</tr>
	<tr>
	    <th>Address: </th>
		<td><textarea rows='3' cols='30' name="address"></textarea></td>
	</tr>
	<tr>
	    <th>Monthly Salary: </th>
		<td><input type="text" name="sal"></td>
	</tr>
	<tr>
	    <th>Employee ID: </th>
		<td><input type="text" name="eid"></td>
	</tr>
	<tr>
	    <th>Password: </th>
		<td><input type="text" name="pass"></td>
	</tr>
	<tr>
	    <th>  </th>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
  </table>
</form>

<a href="manager.php"><h4>Back to admin page</h4></a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>
