<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addTerm'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$termID = $_POST['add_termID'];
	$termName = $_POST['add_termName'];
	$weeksNo = $_POST['add_weeksNo'];
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
		$query=mysqli_query($con,"INSERT INTO t_product_term (TermID, TermName, WeeksNo, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$termID', '$termName', '$weeksNo', '$isActive', NOW(), '$EmployeeID', null, null)");
    
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

	$edit_termID = $_POST['edit_termID'];
	$edit_termName = $_POST['edit_termName'];
	$edit_weeksNo = $_POST['edit_weeksNo'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product_term WHERE (id='$pk_id' AND TermID='$edit_termID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_product_term SET TermName = '$edit_termName',WeeksNo = '$edit_weeksNo', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND TermID='$edit_termID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Branch ID Does Not Exist!'));


		
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

