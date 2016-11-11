<?php
session_start();
	if (!isset($_SESSION["manager"])) {
		header('Location: index.php');
		exit;
	}

	require_once('mysql_conn.php');
	$dept = $_REQUEST['dtype'];
	$name = $_REQUEST['name'];
	$date = $_REQUEST['date'];
	$gender = $_REQUEST['gender'];
	$phone = $_REQUEST['phone'];
	$address = $_REQUEST['address'];
	$eid = mysql_escape_string($_REQUEST['eid']);
	$password = mysql_escape_string($_REQUEST['pass']);
	$sal = $_REQUEST['sal'];
	$msg="";
	$msg1="";


		$query = mysql_query("SELECT * FROM `employee` WHERE e_id='$eid'");
		$nn = mysql_num_rows($query);
		if($nn == 0 && !preg_match('/^ *$/', $name))
		{
			$sql1 ="INSERT INTO `login` (uname, pass, acctype) 
			VALUES ('$eid', '$password', 'Employee')";
			if(!mysql_query($sql1))
				{
					echo "Error in login: " . $sql1. "<br>" . mysql_error($conn);
				}
			
			$sql = "INSERT INTO `employee`(`e_id`, `name`, `dept`, `salary`, `phone`, `gender`, `dob`, `address`) 
			VALUES ('$eid','$name','$dept','$sal','$phone','$gender','$date','$address')";
			if(!mysql_query($sql))
				{
					echo "Error in employee: " . $sql . "<br>" . mysql_error($conn);
				}			
			else
				$msg= 'Employee Successfully Inserted';
		}
		else
			$msg1= 'Invalid input or Employee ID already exist';
?>
<html>
<head><title>Employee Confirmation</title></head>
<center>
<h1>Employee Confirmation</h1>
<hr>
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $msg1; ?></p>
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>
