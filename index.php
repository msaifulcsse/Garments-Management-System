<?php
session_start();
	
require_once('mysql_conn.php');
$err = "";
	if($_SERVER["REQUEST_METHOD"] == "POST")
		{
	 $username = $_POST['uname'];
	 $password = $_POST['pass'];

	$sql = "SELECT * FROM login";
	$result = mysql_query($sql);
		 
		while($row = mysql_fetch_array($result))
		{
		   $un= $row['uname'];
		   $up= $row['pass'];
		   $acctype = $row['acctype'];
		   
		   if($un == $username && $up == $password && $acctype=="Manager")
			{
				//echo 'success in manager';
				$_SESSION["manager"] = $username;
				header('Location: manager.php');
				exit;
			}
			else if($un == $username && $up == $password && $acctype=="Employee")
			{
				$_SESSION["employee"] = $username;
				header('Location: employee.php');
				exit;
				
			}
		   else
			{
				$err = 'Invalid ID or Pass';
			}
		}
	}
?>


<html>
<head><title>Login Page</title></head>
<center>
<h1>Login Page</h1>
<hr>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
<table>
<tr>

<th>User ID: </th> <td><input type="text" name="uname"></td>
</tr>
<tr>
<th>Password: </th> <td><input type="password" name="pass"></td>
</tr>
<tr>
<th> </th>
<td>		<p style="color:red"><?php echo $err; ?></p>
			<input type="submit" name="submit" value="Login">
</td>
</tr>
</table
</form>
</center>

</html>