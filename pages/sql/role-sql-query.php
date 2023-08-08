<?php
error_reporting(0);

include("../../database/connection.php");


// add role
if($_POST['process']=='addRole'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$roleID = $_POST['add_roleID'];
	$roleName = $_POST['add_roleName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_user_roles WHERE RoleID='$roleID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Role ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Role 
		$query=mysqli_query($con,"INSERT INTO t_user_roles (RoleID, RoleName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$roleID', '$roleName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Role added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Role
if($_POST['process']=='editRole'){

	$edit_roleID = $_POST['edit_roleID'];
	$edit_roleName = $_POST['edit_roleName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_roles WHERE (id='$pk_id' AND RoleID='$edit_roleID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_user_roles SET RoleName = '$edit_roleName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND RoleID='$edit_roleID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Role ID Does Not Exist!'));


		
	}

}

// delete Role
if($_POST['process']=='deleteRole'){

	$role_id=$_POST['role_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_roles WHERE (id='$pk_id' AND RoleID='$role_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_user_roles WHERE (id='$pk_id' AND RoleID='$role_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Role Does Not Exist!'));


		
	}

}



?>

