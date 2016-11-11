<?php
require_once('mysql_conn.php');

$username=mysql_escape_string($_REQUEST['uname']);
$password=mysql_escape_string($_REQUEST['pass']);
$type=mysql_escape_string($_REQUEST['utype']);

$sql = "SELECT * FROM login";
$result = mysql_query($sql);
     
    while($row = mysql_fetch_array($result))
    {
       $un= $row['uname'];
       $up= $row['pass'];
	   $acctype = $row['acctype'];
	   
	   if($un == $username && $up == $password && $acctype=="Manager")
		{
			echo 'success in manager';
			require_once('manager.php');
		}
		else if($un == $username && $up == $password && $type=="Employee")
		{
			echo 'success in employee';
			
		}
	   else
		{
			echo 'fail';
		}
    }
?>