<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addEmployee'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$FirstName = strtoupper($_POST['add_fname']);
	$MiddleName = strtoupper($_POST['add_mname']);
	$LastName = strtoupper($_POST['add_lname']);
	$Birthday = $_POST['add_bday'];
	$ContactNo = $_POST['add_contactno'];
	$Email = $_POST['add_email'];
	$DepartmentID = $_POST['add_deptID'];
	$PositionID = $_POST['add_posID'];
	$isActive = $_POST['add_isActive'];

	// Function to generate a formatted client ID
	function generateEmployeeID($number) {
		return str_pad($number, 4, '0', STR_PAD_LEFT);
	}

	$query_checkEmployeeID=mysqli_query($con,"SELECT COUNT(EmployeeID) AS employee_count FROM t_employee");
	$row = mysqli_fetch_assoc($query_checkEmployeeID);
	$lastNumber = $row['employee_count'] ?? 0;

	// Generate a new client ID
	$newNumber = $lastNumber + 1;
	$Gen_EmployeeID = generateEmployeeID($newNumber);


	$query_check=mysqli_query($con,"SELECT * FROM t_employee WHERE EmployeeID='$Gen_EmployeeID'");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, EmployeeID ID Has Already Exist!, Kindly try to re-submit.'));
	}
	else
	{

	

		// insert new Branch 
		$query=mysqli_query($con,"INSERT INTO t_employee ( EmployeeID, FirstName, MiddleName, LastName, DeptID, PositionID, ContactNo, Email, Birthday, isActive, CreatedAt, CreatedBy, UpdatedAt, UpdatedBy) 
		VALUES ('$Gen_EmployeeID', '$FirstName', '$MiddleName', '$LastName', '$DepartmentID', '$PositionID', '$ContactNo', '$Email', '$Birthday', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Employee Successfully added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}


// edit Employee
if($_POST['process']=='editEmployee'){

	$pk_id = $_POST['pk_id'];
    $EmployeeID_Edit = $_POST['employee_id'];
    $EmployeeID = $_POST['EmployeeID'];
	$edit_lname = strtoupper($_POST['edit_lname']);
	$edit_fname = strtoupper($_POST['edit_fname']);
	$edit_mname = strtoupper($_POST['edit_mname']);
	$edit_bday = $_POST['edit_bday'];
	$edit_contactno = $_POST['edit_contactno'];
	$edit_email = $_POST['edit_email'];
	$edit_deptID = $_POST['edit_deptID'];
	$edit_posID = $_POST['edit_posID'];
	$edit_isActive = $_POST['edit_isActive'];


	$query_check=mysqli_query($con,"SELECT * FROM t_employee WHERE (id='$pk_id' AND EmployeeID='$EmployeeID_Edit')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_employee SET FirstName = '$edit_fname', MiddleName = '$edit_mname', LastName = '$edit_lname', Birthday = '$edit_bday', ContactNo = '$edit_contactno', Email = '$edit_email', DeptID = '$edit_deptID', PositionID = '$edit_posID', isActive = '$edit_isActive', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND EmployeeID='$EmployeeID_Edit')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Update Complete!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Update Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Employee Does Not Exist!'));


		
	}

}

// delete Client
if($_POST['process']=='deleteEmployee'){

	$employee_id=$_POST['employee_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_employee WHERE (id='$pk_id' AND EmployeeID='$employee_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_employee WHERE (id='$pk_id' AND EmployeeID='$employee_id')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Successfully Deleted!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Employee Does Not Exist!'));


		
	}

}



?>

