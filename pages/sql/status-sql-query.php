<?php
error_reporting(0);

include("../../database/connection.php");


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

	$edit_statusID = $_POST['edit_statusID'];
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

