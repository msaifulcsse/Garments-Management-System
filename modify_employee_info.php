<?php
require_once('mysql_conn.php');
$sql1 ="SELECT * FROM department";
$result1 = mysql_query($sql1);
$sql2 ="SELECT * FROM login";
$result2 = mysql_query($sql2);
$msg="";
$errmsg="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$id="";
	$setEID="";
	$sql ="SELECT * FROM employee";
	$result = mysql_query($sql);
	$sname=mysql_escape_string($_REQUEST['sname']);
	while($row = mysql_fetch_array($result))
	{
		$e_id= $row['e_id'];
		if($sname == $e_id)
		{
			$setName = $row['name'];
			$setDept = $row['dept'];
			$setSal = $row['salary'];
			$setGen = $row['gender'];
			$setDOB = $row['dob'];
			$setPhn = $row['phone'];
			$setAdrs = $row['address'];
			$setEID = $row['e_id'];
			while($row2 = mysql_fetch_array($result2))
			{
				$e_id2= $row2['uname'];
				if($sname == $e_id2)
				{
					$setPass = $row2['pass'];
				}
			}
		}
		
	}
	
	$id=$setEID;
	if($sname==$id)
	{	$name = $_REQUEST['ename'];
		$eid = mysql_escape_string($_REQUEST['eid']);
		// && !preg_match('/^ *$/', $name)
		if($_REQUEST['doption'] == "Update Employee Info")
		{
			$dept = $_REQUEST['dtype'];
			$sal = $_REQUEST['sal'];
			$name = $_REQUEST['ename'];
			$date = $_REQUEST['date'];
			$gender = $_REQUEST['gname'];
			$phone = $_REQUEST['phone'];
			$address = $_REQUEST['address'];		
			$password = mysql_escape_string($_REQUEST['pass']);


			$query = mysql_query("SELECT * FROM `employee` WHERE e_id='$eid'");
			$nn = mysql_num_rows($query);
			if($nn != 0)
			{
				$sql4 = "UPDATE `employee` SET `name`='$name',`dept`='$dept',`salary`='$sal',`phone`='$phone',`gender`='$gender',`dob`='$date',`address`='$address' WHERE e_id='$eid'";
				if(!mysql_query($sql4))
					{
						echo "Error in employee: " . $sql4. "<br>" . mysql_error($conn);
					}


				$sql3 ="UPDATE `login` SET `uname`='$eid',`pass`='$password',`acctype`='Employee' WHERE uname='$eid'";
				if(!mysql_query($sql3))
					{
						echo "Error in login: " . $sql3 . "<br>" . mysql_error($conn);
					}
				else
				{
					$msg= 'Data Successfully Updated';
					$setName="";
					$setDept ="";
					$setSal = "";
					$setGen = "";
					$setDOB = "";
					$setPhn = "";
					$setAdrs = "";
					$setEID = "";
					$setPass ="";
				}
			}
			/*else
				echo 'Employee ID already exist';*/

		}
		else if($_REQUEST['doption'] == "Remove Employee Info")
		{
			$usql= "DELETE FROM `salary` WHERE e_id='$eid'";
				if(!mysql_query($usql))
				{
					echo "Error: " . $usql . "<br>" . mysql_error($conn);
				}
			$usql= "DELETE FROM `attendance` WHERE e_id='$eid'";
				if(!mysql_query($usql))
				{
					echo "Error: " . $usql . "<br>" . mysql_error($conn);
				}
			$usql= "DELETE FROM `employee` WHERE e_id='$eid'";
				if(!mysql_query($usql))
				{
					echo "Error: " . $usql . "<br>" . mysql_error($conn);
				}	
				$usql= "DELETE FROM `login` WHERE uname='$eid'";
				if(!mysql_query($usql))
				{
					echo "Error: " . $usql . "<br>" . mysql_error($conn);
				}
				else
				{
					$msg= "Successfully Deleted";
					$setName="";
					$setDept ="";
					$setSal = "";
					$setGen = "";
					$setDOB = "";
					$setPhn = "";
					$setAdrs = "";
					$setEID = "";
					$setPass ="";
				}
				
		}

	}
	else
	{	
		$errmsg = "ID not found";
		$setName="";
		$setDept ="";
		$setSal ="";
		$setGen = "";
		$setDOB = "";
		$setPhn = "";
		$setAdrs = "";
		$setEID = "";
		$setPass ="";
	}
}
else
{
	$setName="";
	$setDept ="";
	$setSal ="";
	$setGen = "";
	$setDOB = "";
	$setPhn = "";
	$setAdrs = "";
	$setEID = "";
	$setPass ="";
}

?>

<html>
<head><title>For Modifying & Sacking Employee.</title></head>
    <center>
<h1>Modify/Remove Employee Info</h1>
<hr>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
     <table>
		
		<tr>
		    <th>Search Employee: </th>
			<td><input type="text" name="sname"></td>
		</tr>
		<tr>
		    <th>  </th>
            <td><input type="submit" name="submit" value="Search"></td>
		</tr>
		<tr>
		    <th>Name: </th>
			<td><input type="text" name="ename" value="<?php echo $setName ?>">
			</td>
		</tr>
		<tr>
		    <th>Current Department: </th>
			<td><input type="text" name="dname" value="<?php echo $setDept ?>" disabled>
			</td>
		</tr>
		<tr>
		    <th>Change Department: </th>
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
		    <th>Gender: </th>
			<td><input type="text" name="gname" value="<?php echo $setGen ?>">
			</td>
		</tr>
		<tr>
		    <th>Date of Birth: </th>
			<td><input type="date" name="date" value="<?php echo $setDOB ?>">
			</td>
		</tr>
		<tr>
		    <th>Phone: </th>
			<td><input type="text" name="phone" value="<?php echo $setPhn ?>">
			</td>
		</tr>
		<tr>
		    <th>Address: </th>
			<td><textarea rows='3' cols='30' name="address"><?php echo $setAdrs ?></textarea>
			</td>
		</tr>
		<tr>
		    <th>Monthly Salary: </th>
			<td><input type="text" name="sal" value="<?php echo $setSal ?>">
			</td>
		</tr>
		<tr>
		    <th>Employee ID: </th>
			<td><input type="text" name="eid" value="<?php echo $setEID ?>">
			</td>
		</tr>
		<tr>
		    <th>Password: </th>
			<td><input type="text" name="pass" value="<?php echo $setPass ?>">
			</td>
		</tr>
		<tr>
		    <th>Select an Option: </th>
			<td><select name="doption">
					<option>Update Employee Info</option>
					<option>Remove Employee Info</option>
				</select>
			</td>
		</tr>
		<tr>
		    <th>  </th>
			<td>
			<input type="submit" name="submit" value="Submit">
			<p style="color:green"><?php echo $msg; ?></p>
            <p style="color:red"><?php echo $errmsg; ?></p>
			</td>
		</tr>	
</table>
</form>	
<a href="manager.php">Back to admin page</a>
<a href="logout.php"><h3>Logout</h3></a>
    </center>
</html>