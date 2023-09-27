<?php
error_reporting(0);

include("../../database/connection.php");

// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.DeptID,
				t1.DeptName,
				t1.CreatedAt,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
			FROM t_department t1 
			LEFT JOIN t_employee t2
			ON t1.CreatedBy = t2.EmployeeID 
			LEFT JOIN t_employee t3
			ON t1.UpdatedBy = t3.EmployeeID";

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


// add role
if($_POST['process']=='addDepartment'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$deptID = $_POST['add_deptID'];
	$deptName = $_POST['add_deptName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_department WHERE DeptID='$deptID' OR DeptName='$deptName'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Department ID or Department Name Has Already Exist!'));
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

	$dept_id = $_POST['dept_id'];
	$edit_deptName = $_POST['edit_deptName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_department WHERE (id='$pk_id' AND DeptID='$dept_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_department SET DeptName = '$edit_deptName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND DeptID='$dept_id')");

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

