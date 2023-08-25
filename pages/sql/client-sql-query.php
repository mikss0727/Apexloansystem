<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addClient'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$BranchID = $_POST['add_branchid'];
	$FirstName = strtoupper($_POST['add_fname']);
	$MiddleName = strtoupper($_POST['add_mname']);
	$LastName = strtoupper($_POST['add_lname']);
	$Birthday = $_POST['add_bday'];
	$ContactNo = $_POST['add_contactno'];
	$Address = $_POST['add_address'];
	$Email = $_POST['add_email'];
	$BusinessName = $_POST['add_bussName'];
	$BusinessAddress = $_POST['add_bussAdd'];
	$Gender = $_POST['add_gender'];
	$MaritalStatus = $_POST['add_maritalStatus'];
	$Age = $_POST['add_age'];

	// Function to generate a formatted client ID
	function generateClientID($number) {
		return "C" . str_pad($number, 4, '0', STR_PAD_LEFT);
	}

	$query_checkClientID=mysqli_query($con,"SELECT COUNT(ClientID) AS client_count FROM t_client");
	$row = mysqli_fetch_assoc($query_checkClientID);
	$lastNumber = $row['client_count'] ?? 0;

	// Generate a new client ID
	$newNumber = $lastNumber + 1;
	$ClientID = generateClientID($newNumber);


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE ClientID='$ClientID'");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Client ID Has Already Exist!, Kindly try to re-submit.'));
	}
	else
	{

	

		// insert new Branch 
		$query=mysqli_query($con,"INSERT INTO t_client ( ClientID, BranchID, FirstName, MiddleName, LastName, Birthday, ContactNo, Address, Email, BusinessName, BusinessAddress, Gender, MaritalStatus, Age, CreatedAt, StatusID, CreatedBy, UpdatedAt, UpdatedBy) 
		VALUES ('$ClientID', '$BranchID', '$FirstName', '$MiddleName', '$LastName', '$Birthday', '$ContactNo', '$Address', '$Email', '$BusinessName', '$BusinessAddress', '$Gender', '$MaritalStatus', '$Age', NOW(), 'PND', '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Client Successfully added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// process Client
if($_POST['process']=='processClient'){

	$pk_id = $_POST['p_pk_id'];
	$client_id = $_POST['p_client_id'];
    $EmployeeID = $_POST['EmployeeID'];
	$status_id = $_POST['v_statusID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE (id='$pk_id' AND ClientID='$client_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		// Apprved/reject client
		$query=mysqli_query($con,"UPDATE t_client SET  StatusID = '$status_id', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND ClientID='$client_id')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Client process successfully!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Process Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Client Does Not Exist!'));


		
	}

}


// edit Client
if($_POST['process']=='editClient'){

	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];
	$client_id = $_POST['client_id'];
	$status_id = $_POST['status_id'];
	$edit_lname = $_POST['edit_lname'];
	$edit_fname = $_POST['edit_fname'];
	$edit_mname = $_POST['edit_mname'];
	$edit_branchid = $_POST['edit_branchid'];
	$edit_bday = $_POST['edit_bday'];
	$edit_contactno = $_POST['edit_contactno'];
	$edit_address = $_POST['edit_address'];
	$edit_email = $_POST['edit_email'];
	$edit_bussName = $_POST['edit_bussName'];
	$edit_bussAdd = $_POST['edit_bussAdd'];
	$edit_gender = $_POST['edit_gender'];
	$edit_age = $_POST['edit_age'];
	$edit_maritalStatus = $_POST['edit_maritalStatus'];


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE (id='$pk_id' AND ClientID='$client_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_client SET BranchID = '$edit_branchid', FirstName = '$edit_fname', MiddleName = '$edit_mname', LastName = '$edit_fname', Birthday = '$edit_bday', ContactNo = '$edit_contactno', Address = '$edit_address', Email = '$edit_email', BusinessName = '$edit_bussName', BusinessAddress = '$edit_bussAdd', Gender = '$edit_gender', MaritalStatus = '$edit_maritalStatus', Age = '$edit_age', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND ClientID='$client_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Client Does Not Exist!'));


		
	}

}

// delete Client
if($_POST['process']=='deleteClient'){

	$client_id=$_POST['client_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE (id='$pk_id' AND ClientID='$client_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_client WHERE (id='$pk_id' AND ClientID='$client_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Client Does Not Exist!'));


		
	}

}



?>

