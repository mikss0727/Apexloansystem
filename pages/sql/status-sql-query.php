<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
					t1.id,
					t1.StatusID,
					t1.StatusName,
					t1.CreatedAt,
					CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
					t1.isActive,
					t1.UpdatedAt,
					CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
				FROM t_status t1 
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


// add status
if($_POST['process']=='addStatus'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$statusID = $_POST['add_statusID'];
	$statusName = $_POST['add_statusName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_status WHERE StatusID='$statusID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Status ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Status 
		$query=mysqli_query($con,"INSERT INTO t_status (StatusID, StatusName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$statusID', '$statusName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Status added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Status
if($_POST['process']=='editStatus'){

	$edit_statusID = $_POST['status_id'];
	$edit_statusName = $_POST['edit_statusName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_status WHERE (id='$pk_id' AND StatusID='$edit_statusID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_status SET StatusName = '$edit_statusName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND StatusID='$edit_statusID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Status ID Does Not Exist!'));


		
	}

}

// delete Status
if($_POST['process']=='deleteStatus'){

	$status_id=$_POST['status_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_status WHERE (id='$pk_id' AND StatusID='$status_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_status WHERE (id='$pk_id' AND StatusID='$status_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Status Does Not Exist!'));


		
	}

}



?>

