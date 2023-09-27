<?php
error_reporting(0);

include("../../database/connection.php");

// get table data 

if($_POST['process']=='getData'){
	
	$query = "SELECT 
				t1.id,
				t1.ProductID,
				t1.ProductName,
				t1.LoanAmount,
				t1.TermID,
				t4.TermName,
				t4.TermNo,
				t1.CreatedAt,
				CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
				t1.isActive,
				t1.UpdatedAt,
				CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
			FROM t_product t1 
			LEFT JOIN t_employee t2
			ON t1.CreatedBy = t2.EmployeeID 
			LEFT JOIN t_employee t3
			ON t1.UpdatedBy = t3.EmployeeID
			LEFT JOIN t_product_term t4
			ON t1.TermID = t4.TermID";

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



// add Product
if($_POST['process']=='addProduct'){
    
    $EmployeeID = $_POST['EmployeeID'];
	$productID = $_POST['add_productID'];
	$productName = $_POST['add_productName'];
	$loanAmount = $_POST['add_loanAmount'];
	$TermID = $_POST['add_term'];
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
		$query=mysqli_query($con,"INSERT INTO t_product (ProductID, ProductName, LoanAmount, TermID, isActive, CreatedAt, CreatedBy, UpdatedBy, UpdatedAt) VALUES ('$productID', '$productName', '$loanAmount', '$TermID', '$isActive', NOW(), '$EmployeeID', null, null)");
    
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

	$edit_productID = $_POST['product_id'];
	$edit_productName = $_POST['edit_productName'];
	$edit_loanAmount = $_POST['edit_loanAmount'];
	$edit_term = $_POST['edit_term'];
	$edit_isActive = $_POST['edit_isActive'];
	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_product WHERE (id='$pk_id' AND ProductID='$edit_productID')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_product SET ProductName = '$edit_productName',LoanAmount = '$edit_loanAmount' ,TermID = '$edit_term' , isActive = '$edit_isActive', UpdatedBy = '$EmployeeID', UpdatedAt = NOW() WHERE (id='$pk_id' AND ProductID='$edit_productID')");

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

