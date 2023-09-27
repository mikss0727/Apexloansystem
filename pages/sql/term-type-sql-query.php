<?php
error_reporting(0);

include("../../database/connection.php");

// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.TypeID,
				t1.TypeName,
				t1.DaysNo,
				t1.CreatedAt,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
			FROM t_term_type t1 
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


// add branch
if($_POST['process']=='addTermType'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$typeID = $_POST['add_typeID'];
	$typeName = $_POST['add_typeName'];
	$daysNo = $_POST['add_daysNo'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_term_type WHERE TypeID='$typeID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Type ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Type 
		$query=mysqli_query($con,"INSERT INTO t_term_type (TypeID, TypeName, DaysNo, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$typeID', '$typeName', '$daysNo', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Type added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Term
if($_POST['process']=='editTermType'){

	$edit_typeID = $_POST['type_id'];
	$edit_typeName = $_POST['edit_typeName'];
	$edit_daysNo = $_POST['edit_daysNo'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_term_type WHERE (id='$pk_id' AND TypeID='$edit_typeID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_term_type SET TypeName = '$edit_typeName',DaysNo = '$edit_daysNo', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND TypeID='$edit_typeID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Type ID Does Not Exist!'));


		
	}

}

// delete Type
if($_POST['process']=='deleteTermType'){

	$type_id=$_POST['type_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_term_type WHERE (id='$pk_id' AND TypeID='$type_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_term_type WHERE (id='$pk_id' AND TypeID='$type_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Type Does Not Exist!'));


		
	}

}



?>

