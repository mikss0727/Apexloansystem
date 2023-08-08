<?php
error_reporting(0);

include("../../database/connection.php");


// add role
if($_POST['process']=='addDepartment'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$deptID = $_POST['add_deptID'];
	$deptName = $_POST['add_deptName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_department WHERE DeptID='$deptID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Department ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Dept 
		$query=mysqli_query($con,"INSERT INTO t_department (DeptID, DeptName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$deptID', '$deptName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Department added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Role
if($_POST['process']=='editDepartment'){

	$edit_deptID = $_POST['edit_deptID'];
	$edit_deptName = $_POST['edit_deptName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_department WHERE (id='$pk_id' AND DeptID='$edit_deptID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_department SET DeptName = '$edit_deptName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND DeptID='$edit_deptID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Department ID Does Not Exist!'));


		
	}

}

// delete Role
if($_POST['process']=='deleteDepartment'){

	$dept_id=$_POST['dept_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_department WHERE (id='$pk_id' AND DeptID='$dept_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_department WHERE (id='$pk_id' AND DeptID='$dept_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Department Does Not Exist!'));


		
	}

}



?>

