<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');

if($_SERVER["REQUEST_METHOD"] == "GET")
{	
	$dept = $_GET['dtype'];
	$sql ="SELECT * FROM employee where dept='$dept'";
	$result = mysql_query($sql);
	$select = 1;
			
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	$date = date("d/m/Y");
	
	foreach ($_REQUEST['attend'] as $pvalue) {
		$value = strip_tags($pvalue, '</td>');	
		$sqlinsert = "INSERT INTO `attendance` (`e_id`, `attend_date`, `attend`) VALUES ('$value', '$date', '1')";
		if(!mysql_query($sqlinsert))
			{
				echo "Error: " . $sqlinsert . "<br>" . mysql_error($conn);
			}
		}
	$select = 0;		
}


?>



<html>
<head><title>Attendance Taking</title></head>
<center>
    <h1>Daily Attendance</h1>
<h3>Today is: <?php
    echo date("d, M -Y").'('.date("l").')';
			   ?></h3>
<hr> 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

<table border="1" style="width:50%">
	
  <?php
	if($select == 1)
	{
		echo "<tr>\n"; 
echo "<td>User ID</td>\n"; 
echo "<td>Name</td>\n"; 
echo "<td>Department</td>\n"; 
echo "<td>Date</td>\n"; 
echo "<td>Attendence</td>\n"; 
echo "</tr>\n";
		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$setID = $row['e_id']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['dept']."</td>";
			echo "<td>".date("d/m/Y")."</td>";
			echo '<td><input type="checkbox" name="attend[]" value="'.  $setID .'" checked>'.'</td>';
			echo "</tr>";
		}
	echo "</table> \n"; 
	echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />\n";
	}
	else
		echo 'DONE'.'<br>';
  ?>
</table>
</form>
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>

