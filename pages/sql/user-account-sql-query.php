<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.EmployeeID,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'EmployeeName',
				t1.RoleID,
				t1.BranchID,
				t5.BranchName,
				t1.CreatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t4.LastName,', ',t4.FirstName,' ',t4.MiddleName) AS 'UpdatedBy'
			FROM t_user_account t1 
			LEFT JOIN t_employee t2
			ON t1.EmployeeID = t2.EmployeeID 
			LEFT JOIN t_employee t3
			ON t1.CreatedBy = t3.EmployeeID
			LEFT JOIN t_employee t4
			ON t1.UpdatedBy = t4.EmployeeID
			LEFT JOIN t_branch t5
			ON t1.BranchID = t5.BranchID";

				$stmt = mysqli_prepare($con, $query);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				$dataArray = array(); // Initialize an empty array to store the data

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$dataArray[] = $row; // Add each row to the array
					}
					echo json_encode(
						array(
							"message" => "Successfully fetched data.", 
							"data" => $dataArray
						)
					);
				} else {
					echo json_encode(
						array(
							"message" => "No Data found.",
							"data" => $dataArray
						)
					);
				}
												
												
}


// add addUserAccount
if($_POST['process']=='addUserAccount'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$add_Branch = $_POST['add_Branch'];
	$add_EmpID = $_POST['add_EmpID'];
	$add_Role = $_POST['add_Role'];
	$add_isActive = $_POST['add_isActive'];


	$query_check=mysqli_query($con,"SELECT * FROM t_user_account WHERE EmployeeID='$add_EmpID'");
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

