<?php
	session_start();
	if (!isset($_SESSION["manager"])) {
		header('Location: index.php');
		exit;
	}
?>

<html>
<head><title>Manager Site</title></head>
    <center>
<h1>Manager</h1>
        <hr>

  <a href="add_department.php">Add a department</a><br>
  <a href="add_employee.php">Add an employee</a><br>
  <a href="modify_dept_info.php">Modify department information</a><br>
  <a href="modify_employee_info.php">Modify employee information</a><br>
  <a href="attendence.php">Submit department wise daily attendance</a><br>
  <a href="salary.php">View department wise salary, absent days and payable salary of each employee</a><br>
  <a href="totalsal.php">View the total amount of payable salary at the end of the month</a><br>
  
<a href="logout.php"><h3>Logout</h3></a>
</center>
</html>