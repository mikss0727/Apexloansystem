<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
					t1.id,
					t1.RateID,
					t1.RateName,
					t1.Rate,
					t1.CreatedAt,
					CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
					t1.isActive,
					t1.UpdatedAt,
					CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
				FROM t_interest_rate t1 
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

	$edit_rateID = $_POST['rate_id'];
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

