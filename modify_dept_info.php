<?php
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
	require_once('mysql_conn.php');
	$sql ="SELECT * FROM department";
	$result = mysql_query($sql);
	$msg="";
	$msg1="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$dname = $_REQUEST['dname'];
		$dtype = $_REQUEST['dtype'];
		if($_REQUEST['doption'] == "Update Department")
		{
			$verify = "";
			while ($search =  mysql_fetch_array($result))
			{
				$sdept = $search['dept_name'];
				if($sdept==$dname)
				{
					$verify="found";
				}
			}
			if($verify != "found" && !preg_match('/^ *$/', $dname))
			{
				$usql= "UPDATE `department` SET `dept_name`='$dname' WHERE dept_name='$dtype'";
				if(!mysql_query($usql))
				{
					echo "Error in login: " . $usql . "<br>" . mysql_error($conn);
				}
				$usql1= "UPDATE `employee` SET `dept`='$dname' WHERE dept='$dtype'";
                if(!mysql_query($usql1))
                 {
                 echo "Error in login: " . $usql1 . "<br>" . mysql_error($conn);
                 }
				else
					$msg= "Successfully Department Updated";
			}
			else
				$msg1= "Inavlid input or Department already exist";
		}
		else if($_REQUEST['doption'] == "Remove Department")
		{
			$usql= "DELETE FROM `department` WHERE dept_name='$dtype'";
			if(!mysql_query($usql))
			{
				echo "Error in login: " . $usql . "<br>" . mysql_error($conn);
			}
			else
				$msg= "Successfully Department Deleted";
		}

	
	}
?>

<html>
<head><title>For Modifying & Removing Dept.</title></head>
<center>
<h1>Modify/Remove Dept. Info</h1>
<hr>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
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
      <th>Department Name: </th>
	  <td><input type="text" name="dname"></td>
   </tr>
    <tr>
      <th>Select an Option: </th>
	  <td><select name="doption">
					<option>Update Department</option>
					<option>Remove Department</option>
				</select>
	  </td>
   </tr>
   <tr>
      <th>  </th>
	  <td><input type="submit" name="submit" value="Submit"></td>
   </tr>
  </table>   
</form>
  
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $msg1; ?></p>
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
    </center>
</html>