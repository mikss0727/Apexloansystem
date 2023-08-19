<?php
error_reporting(0);

include("../../database/connection.php");


// add branch
if($_POST['process']=='addProduct'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$productID = $_POST['add_productID'];
	$productName = $_POST['add_productName'];
	$loanAmount = $_POST['add_loanAmount'];
	$isActive = $_POST['add_isActive'];

    
	$query_check=mysqli_query($con,"SELECT * FROM t_product WHERE ProductID='$productID'");
    

	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Product ID Has Already Exist!'));
	}
	else
	{

        
		// insert new Product 
		$query=mysqli_query($con,"INSERT INTO t_product (ProductID, ProductName, LoanAmount, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$productID', '$productName', '$loanAmount', '$isActive', NOW(), '$EmployeeID', null, null)");
    
		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Product added!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// edit Product
if($_POST['process']=='editProduct'){

	$edit_productID = $_POST['edit_productID'];
	$edit_productName = $_POST['edit_productName'];
	$edit_loanAmount = $_POST['edit_loanAmount'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product WHERE (id='$pk_id' AND ProductID='$edit_productID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_product SET ProductName = '$edit_productName',LoanAmount = '$edit_loanAmount', isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND ProductID='$edit_productID')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Product ID Does Not Exist!'));


		
	}

}

// delete Product
if($_POST['process']=='deleteProduct'){

	$product_id=$_POST['product_id'];
	$pk_id=$_POST['pk_id'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product WHERE (id='$pk_id' AND ProductID='$product_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		$query=mysqli_query($con,"DELETE FROM t_product WHERE (id='$pk_id' AND ProductID='$product_id')");

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

		echo json_encode(array("statusCode"=>1,"message"=>'Product Does Not Exist!'));


		
	}

}



?>

