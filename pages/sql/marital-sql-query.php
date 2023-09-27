<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
			t1.id,
			t1.MaritalID,
			t1.MaritalName,
			t1.CreatedAt,
			CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
			t1.isActive,
			t1.UpdatedAt,
			CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
		FROM t_marital_status t1 
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

	$edit_maritalID = $_POST['marital_id'];
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

