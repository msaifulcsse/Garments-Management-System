<?php
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
	require_once('mysql_conn.php');
	$msg = "";
	$msg1 = "";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$dname= $_POST['dname'];
		$sql ="SELECT * FROM department";
		$result = mysql_query($sql);
		$verify = "";
		while ($row =  mysql_fetch_array($result))
		{
			$sdept = $row['dept_name'];
			if($sdept==$dname)
			{
				$verify="found";
			}
		}
		//echo preg_match('/^ *$/', $dname);
		if($verify != "found" && !preg_match('/^ *$/', $dname))
		{
			$sql1 ="INSERT INTO `department` (dept_name) 
			VALUES ('$dname')";
			if(!mysql_query($sql1))
				{
					echo "Error in login: " . $sql1 . "<br>" . mysql_error($conn);
				}
			else
				$msg= 'Department Added';
		}
		
		
		else
			$msg1='Invalid input or Department already exist';
	}
?>

<html>
<head><title>For Adding Department</title></head>
<center>
	<h1> Add New Department</h1>
	<hr>
	
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <table>
		<tr>
		   <th>Department Name: </th>
		   <td><input type="text" name="dname"></td>
		</tr>
		<tr>
		   <th>  </th>
		   <td><input type="submit" name="submit" value="AddDept."></td>
		</tr>
    </table>
 </form>
	<p style="color:green"><?php echo $msg; ?></p>
	<p style="color:red"><?php echo $msg1; ?></p>
	<a href="manager.php">Back to admin page</a>
	<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>