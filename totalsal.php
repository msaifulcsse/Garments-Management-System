<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

	
?>

<html>
<head><title>Total Salary Info.</title></head>
 <center>
 <h1>Salary Information</h1>
 <hr>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
     <table>
	<tr>
    <th>Select Month: </th>
	<td>		
    <select name="month">
					<option>January</option>
					<option>February</option>
					<option>March</option>
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
        <td><input type="submit" name="submit" value="Search" />
        </td>
    </tr>
	  </table>
</form>
    
    </center>
</html>
<?php 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$month = $_REQUEST['month'];	
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
	require_once('mysql_conn.php');
	$sql ="SELECT * FROM salary where month = '$monthNO'";
	$result = mysql_query($sql);
	$total=0;
	while ($row =  mysql_fetch_array($result))
	{
		$sal= $row['p_salary'];
		$total = $total + $sal;
	}
	echo "<html><center>";
	echo '<h2>'.'Total Playable Salary: '.$total.' Tk'.'</h2>';
	echo "<a href=\"manager.php\">Back to admin page</a>\n"; 
    echo "<a href=\"logout.php\"><h3>Logout</h3></a>\n";
	echo "</center></html>";
}


?>