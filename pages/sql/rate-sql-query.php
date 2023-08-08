<?php
error_reporting(0);

include("../../database/connection.php");


// add rate
if($_POST['process']=='addRate'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$rateID = $_POST['add_rateID'];
	$rateName = $_POST['add_rateName'];
	$rate = $_POST['add_rate'];
	$isActive = $_POST['add_isActive'];

	$query_check=mysqli_query($con,"SELECT * FROM
	t_interest_rate WHERE RateID='$rateID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Rate ID Has Already Exist!'));
	}
	else
	{

       
		// insert new Rate 
		$query=mysqli_query($con,"INSERT INTO t_interest_rate (RateID, RateName, Rate, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$rateID', '$rateName', '$rate', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Rate added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Rate
if($_POST['process']=='editRate'){

	$edit_rateID = $_POST['edit_rateID'];
	$edit_rateName = $_POST['edit_rateName'];
	$edit_rate = $_POST['edit_rate'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_interest_rate WHERE (id='$pk_id' AND RateID='$edit_rateID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_interest_rate SET RateName = '$edit_rateName', Rate = '$edit_rate', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND RateID='$edit_rateID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Rate ID Does Not Exist!'));


		
	}

}

// delete Rate
if($_POST['process']=='deleteRate'){

	$rate_id=$_POST['rate_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_interest_rate WHERE (id='$pk_id' AND RateID='$rate_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_interest_rate WHERE (id='$pk_id' AND RateID='$rate_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Rate Does Not Exist!'));


		
	}

}



?>

