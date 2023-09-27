<?php
error_reporting(0);

include("../../database/connection.php");

// get table data 
if($_POST['process']=='getData'){
	
	$query = "SELECT 
					t1.id,
					t1.BranchID,
					t1.BranchName,
					t1.CreatedAt,
					CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
					t1.isActive,
					t1.UpdatedAt,
					CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
				FROM t_branch t1 
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

	$pk_id = $_POST['pk_id'];
	$branch_id = $_POST['branch_id'];
	$edit_branchName = $_POST['edit_branchName'];
	$edit_isActive = $_POST['edit_isActive'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_branch WHERE (id='$pk_id' AND BranchID='$branch_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_branch SET BranchName = '$edit_branchName', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND BranchID='$branch_id')");

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

