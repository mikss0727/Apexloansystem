<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addBranch'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$branchID = $_POST['add_branchID'];
	$branchName = $_POST['add_branchName'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_branch WHERE BranchID='$branchID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Branch ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Branch 
		$query=mysqli_query($con,"INSERT INTO t_branch (BranchID, BranchName, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$branchID', '$branchName', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Branch added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Branch
if($_POST['process']=='editBranch'){

	$edit_branchID = $_POST['edit_branchID'];
	$edit_branchName = $_POST['edit_branchName'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_branch WHERE (id='$pk_id' AND BranchID='$edit_branchID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_branch SET BranchName = '$edit_branchName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND BranchID='$edit_branchID')");

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

// delete Branch
if($_POST['process']=='deleteBranch'){

	$branch_id=$_POST['branch_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_branch WHERE (id='$pk_id' AND BranchID='$branch_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_branch WHERE (id='$pk_id' AND BranchID='$branch_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Branch Does Not Exist!'));


		
	}

}



?>

