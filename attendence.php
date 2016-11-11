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
<head><title>For Taking Attendance</title></head>
    <center>
<h1>Daily Attendance</h1>
<h3>Today is: <?php
    echo date("d, M -Y").'('.date("l").')';
			   ?></h3>
<hr>     

<form action="attend.php" method="GET">
  <table>
<tr><th>Select Department: </th>
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
    <th>  </th>
    <td><input type="submit" name="submit" value="Search" /></td>
</tr>
   </table>
</form>
 
<a href="manager.php"><h4>Back to admin page</h4></a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>
