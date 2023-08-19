<?php
error_reporting(0);

include("../../database/connection.php");


// add marital status
if($_POST['process']=='addMarital'){

    $EmployeeID = $_POST['EmployeeID'];
	$maritalID = $_POST['add_maritalID'];
	$maritalName = $_POST['add_maritalName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_marital_status WHERE MaritalID='$maritalID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Marital ID Has Already Exist!'));
	}
	else
	{

        
		// insert new marital 
		$query=mysqli_query($con,"INSERT INTO t_marital_status (MaritalID, MaritalName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$maritalID', '$maritalName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Marital added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit marital
if($_POST['process']=='editMarital'){

	$edit_maritalID = $_POST['edit_maritalID'];
	$edit_maritalName = $_POST['edit_maritalName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_marital_status WHERE (id='$pk_id' AND MaritalID='$edit_maritalID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_marital_status SET MaritalName = '$edit_maritalName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND MaritalID='$edit_maritalID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Marital Status ID Does Not Exist!'));


		
	}

}

// delete marital
if($_POST['process']=='deleteMarital'){

	$marital_id=$_POST['marital_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_marital_status WHERE (id='$pk_id' AND MaritalID='$marital_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_marital_status WHERE (id='$pk_id' AND MaritalID='$marital_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Marital Status Does Not Exist!'));


		
	}

}



?>

