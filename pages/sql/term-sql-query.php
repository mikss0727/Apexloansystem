<?php
error_reporting(0);

include("../../database/connection.php");


// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.TermID,
				t1.TermName,
				t1.TermNo,
				t1.CreatedAt,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
			FROM t_product_term t1 
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
if($_POST['process']=='addTerm'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$termID = $_POST['add_termID'];
	$termName = $_POST['add_termName'];
	$termNo = $_POST['add_termNo'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_product_term WHERE TermID='$termID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Term ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Term 
		$query=mysqli_query($con,"INSERT INTO t_product_term (TermID, TermName, TermNo, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$termID', '$termName', '$termNo', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Term added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Term
if($_POST['process']=='editTerm'){

	$edit_termID = $_POST['type_id'];
	$edit_termName = $_POST['edit_termName'];
	$edit_termNo = $_POST['edit_termNo'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product_term WHERE (id='$pk_id' AND TermID='$edit_termID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_product_term SET TermName = '$edit_termName',TermNo = '$edit_termNo', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND TermID='$edit_termID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Term ID Does Not Exist!'));


		
	}

}

// delete Term
if($_POST['process']=='deleteTerm'){

	$term_id=$_POST['term_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product_term WHERE (id='$pk_id' AND TermID='$term_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_product_term WHERE (id='$pk_id' AND TermID='$term_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Term Does Not Exist!'));


		
	}

}



?>

