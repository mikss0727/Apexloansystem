<?php
error_reporting(0);

include("../../database/connection.php");


// add user
if($_POST['process']=='addPosition'){

    $EmployeeID = $_POST['EmployeeID'];
	$postitionID = $_POST['add_postitionID'];
	$postitionName = $_POST['add_postitionName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_position WHERE PositionID='$postitionID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Position ID Has Already Exist!'));
	}
	else
	{

        
		// insert new position 
		$query=mysqli_query($con,"INSERT INTO t_position (PositionID, PositionName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$postitionID', '$postitionName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
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

	$edit_postitionID = $_POST['edit_postitionID'];
	$edit_postitionName = $_POST['edit_postitionName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_position WHERE (id='$pk_id' AND PositionID='$edit_postitionID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_position SET PositionName = '$edit_postitionName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND PositionID='$edit_postitionID')");

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

