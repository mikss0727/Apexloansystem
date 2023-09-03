<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addUserAccount'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$add_Branch = $_POST['add_Branch'];
	$add_EmpID = $_POST['add_EmpID'];
	$add_Role = $_POST['add_Role'];
	$add_isActive = $_POST['add_isActive'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_account WHERE EmployeeID='$EmployeeID'");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Client Has Already have an Account!'));
	}
	else
	{

	

		// insert new user account 

		// convert the password to md5
        $default_password = '@pex';
		$password_hash=md5(md5($add_EmpID.$default_password."apex"));

		$query=mysqli_query($con,"INSERT INTO t_user_account ( EmployeeID, RoleID, BranchID, Password, isActive, CreatedAt, CreatedBy, UpdatedAt, UpdatedBy) 
		VALUES ('$add_EmpID', '$add_Role', '$add_Branch', '$password_hash', '$add_isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Account Successfully added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit user account
if($_POST['process']=='editUserAccount'){

	$pk_id = $_POST['pk_id'];
	$user_id = $_POST['p_edit_EmpID'];
    $EmployeeID = $_POST['EmployeeID'];
	$branch_id = $_POST['edit_Branch'];
	$role_id = $_POST['edit_Role'];
	$status_id = $_POST['edit_isActive'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_account WHERE (id='$pk_id' AND EmployeeID='$user_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		// update
		$query=mysqli_query($con,"UPDATE t_user_account SET  RoleID = '$role_id', BranchID = '$branch_id', isActive = '$status_id', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND EmployeeID='$user_id')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Account updated successfully!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Account Does Not Exist!'));


		
	}

}



// reset password
if($_POST['process']=='resetPassword'){

	$user_id=$_POST['user_id'];
	$pk_id=$_POST['pk_id'];

    // convert the password to md5
    $default_password = '@P3x';
    // $default_password = 'admin';
    $password_hash=md5(md5($user_id.$default_password."apex"));


	$query_check=mysqli_query($con,"SELECT * FROM t_user_account WHERE (id='$pk_id' AND EmployeeID='$user_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"UPDATE t_user_account SET Password = '$password_hash' WHERE (id='$pk_id' AND EmployeeID='$user_id')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Password Reset Successfully!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Account Does Not Exist!'));


		
	}

}


// delete user account
if($_POST['process']=='deleteUserAccount'){

	$user_id=$_POST['user_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_account WHERE (id='$pk_id' AND EmployeeID='$user_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_user_account WHERE (id='$pk_id' AND EmployeeID='$user_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Account Does Not Exist!'));


		
	}

}




?>

