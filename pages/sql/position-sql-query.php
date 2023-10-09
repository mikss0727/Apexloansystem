<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.PositionID,
				t1.PositionName,
				t1.CreatedAt,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
			FROM t_position t1 
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


// add user
if($_POST['process']=='addPosition'){

    $EmployeeID = $_POST['EmployeeID'];
	$positionID = $_POST['add_positionID'];
	$positionName = $_POST['add_positionName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_position WHERE PositionID='$positionID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Position ID Has Already Exist!'));
	}
	else
	{

        
		// insert new position 
		$query=mysqli_query($con,"INSERT INTO t_position (PositionID, PositionName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$positionID', '$positionName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Position added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit user
if($_POST['process']=='editPosition'){

	$edit_positionID = $_POST['pos_id'];
	$edit_positionName = $_POST['edit_positionName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_position WHERE (id='$pk_id' AND PositionID='$edit_positionID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_position SET PositionName = '$edit_positionName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND PositionID='$edit_positionID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Position ID Does Not Exist!'));


		
	}

}

// delete position
if($_POST['process']=='deletePosition'){

	$pos_id=$_POST['pos_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_position WHERE (id='$pk_id' AND PositionID='$pos_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_position WHERE (id='$pk_id' AND PositionID='$pos_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Position Does Not Exist!'));


		
	}

}



?>

