<?php
error_reporting(0);

include("../../database/connection.php");

if($_POST['process']=='getData'){
    $activeTab = $_POST['status'];
	
	$query = "SELECT 
					t1.id,
					t1.ClientID,
					t1.LastName,
					t1.FirstName,
					t1.MiddleName,
					t1.BranchID,
					t4.BranchName,
					t1.Birthday,
					t1.ContactNo,
					t1.Address,
					t1.Email,
					t1.BusinessName,
					t1.BusinessAddress,
					t1.Gender,
					t1.MaritalStatus,
					t6.MaritalName,
					t1.Age,
					t1.StatusID,
					t5.StatusName,
					t1.CreatedAt,
					CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
					t1.UpdatedAt,
					CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
				FROM t_client t1 
				LEFT JOIN t_employee t2
				ON t1.CreatedBy = t2.EmployeeID 
				LEFT JOIN t_employee t3
				ON t1.UpdatedBy = t3.EmployeeID
				LEFT JOIN t_branch t4
				ON t1.BranchID = t4.BranchID
				LEFT JOIN t_status t5
				ON t1.StatusID = t5.StatusID
				LEFT JOIN t_marital_status t6
				ON t1.MaritalStatus = t6.MaritalID
				WHERE t1.StatusID = ?";

				$stmt = mysqli_prepare($con, $query);
				mysqli_stmt_bind_param($stmt, "s", $activeTab);
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
							"message" => "No Application found.",
							"data" => $dataArray
						)
					);
				}
												
												
}



// add client
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


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE (ClientID='$ClientID') OR (FirstName='$FirstName' AND MiddleName='$MiddleName' AND LastName='$LastName')");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Client ID / Client Name Has Already Exist! Kindly try to re-submit.'));
	}
	else
	{
		// Define the destination path based on $ClientID
		$path = '../../kyc_images/' . $ClientID . '/';
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

		// insert new Client 
		$query=mysqli_query($con,"INSERT INTO t_client ( ClientID, BranchID, FirstName, MiddleName, LastName, Birthday, ContactNo, Address, Email, BusinessName, BusinessAddress, Gender, MaritalStatus, Age, CreatedAt, StatusID, CreatedBy, UpdatedAt, UpdatedBy) 
		VALUES ('$ClientID', '$BranchID', '$FirstName', '$MiddleName', '$LastName', '$Birthday', '$ContactNo', '$Address', '$Email', '$BusinessName', '$BusinessAddress', '$Gender', '$MaritalStatus', '$Age', NOW(), 'IACTV', '$EmployeeID', null, null)");
	
		if($query)
		{
			$loop_count = 0;
			// Loop through the uploaded files
			foreach ($_FILES as $key => $value) {
				// Get the file details
				$imageView = $key;
				$tmpFile = $value['tmp_name'];
				$fileName = $value['name'];
				// Extract the file extension
				$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

				// Check if the file has a valid format
				if (in_array($ext, $valid_extensions)) {
					// Generate a unique name for each image
					// $finalImgName = $ClientID . '_' . $imageView . '.' . $ext;
					$finalImgName = $imageView . '.' . $ext;
					$finalPath = $path . $finalImgName;

					// Move the uploaded file to the destination path
					if (move_uploaded_file($tmpFile, $finalPath)) {
						// The image has been successfully saved
						// You can add any additional processing or database operations here
						// echo "File '$fileName' has been uploaded and saved as '$finalImgName'.<br>";
						$loop_count ++;
					}
					//  else {
					// 	echo json_encode(array("statusCode"=>1,"message"=>'Error Uploading, Please Contact the IT Administrator!'));
					// 	// echo "Error uploading '$fileName'.<br>";
					// }
				} 
				// else {
				// 		// echo "Invalid file format for '$fileName'.<br>";
				// 		echo json_encode(array("statusCode"=>1,"message"=>'Error, Invalid File Format!'));
				// }
			}

			// Move the uploaded file to the destination path
			if ($loop_count == 2) {
				// The image has been successfully saved
				echo json_encode(array("statusCode"=>0,"message"=>'Client Successfully added!'));
			}
			 else {
				echo json_encode(array("statusCode"=>1,"message"=>'Error Uploading Photo, Please Contact the IT Administrator!'));
				// echo "Error uploading '$fileName'.<br>";
			}
			
		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}

}

// process apply Loan
if($_POST['process']=='processApplyLoan'){

	$pk_id = $_POST['l_pk_id'];
	$client_id = $_POST['l_client_id'];
	$branch_id = $_POST['l_branch_id'];
	$loan_product = $_POST['l_loan_product'];
	$loan_rate = $_POST['l_loan_rate'];
	$loan_term_type = $_POST['l_loan_term_type'];
	$loan_disbDate = $_POST['l_loan_disbDate'];
    $EmployeeID = $_POST['EmployeeID'];


	$query_check=mysqli_query($con,"SELECT * FROM t_client WHERE (id='$pk_id' AND ClientID='$client_id')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{
	
			// Function to generate a formatted Application ID
			function generateApplicationID($number) {
				return "AL" . str_pad($number, 10, '0', STR_PAD_LEFT);
			}

			$query_checkApplicationID=mysqli_query($con,"SELECT COUNT(ApplicationNo) AS application_count FROM t_client_application");
			$row = mysqli_fetch_assoc($query_checkApplicationID);
			$lastNumber = $row['application_count'] ?? 0;

			// Generate a new client ID
			$newNumber = $lastNumber + 1;
			$ApplicationID = generateApplicationID($newNumber);


			$query_check=mysqli_query($con,"SELECT * FROM t_client_application WHERE ApplicationNo='$ApplicationID'");
			$num_rows=mysqli_num_rows($query_check);
		
			if($num_rows)
			{
				echo json_encode(array("statusCode"=>1,"message"=>'Error, ApplicationNo Has Already Exist!, Kindly try to re-submit.'));
			}
			else
			{
				
				// insert new Application 
				$query=mysqli_query($con,"INSERT INTO t_client_application ( ApplicationNo, ClientID, BranchID, ProductID, InterestCode, TermType, DisbursementDate, StatusID, LoanType, ClosedDate, CreatedAt, CreatedBy, UpdatedAt, UpdatedBy) 
				VALUES ('$ApplicationID', '$client_id', '$branch_id', '$loan_product', '$loan_rate', '$loan_term_type', '$loan_disbDate', 'PND', 'NL', null, NOW(), '$EmployeeID', null, null)");


				if($query)
				{

						// update client status
						$query_updateClientStatus=mysqli_query($con,"UPDATE t_client SET StatusID = 'ACTV' WHERE (id='$pk_id' AND ClientID='$client_id')");
						// add application process
						$query_addProcess=mysqli_query($con,"INSERT INTO t_applicationprocess (ApplicationNo, ProcessNo, StatusID, ProcessValue, ProcessBy, CreatedAt) VALUES ('$ApplicationID','1','PND','ENCODE','$EmployeeID',NOW())");

						if($query_updateClientStatus){
							echo json_encode(array("statusCode"=>0,"message"=>'Application Successfully Created!'));
						}
						else{
							echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator! Application Created, Failed to Update Client Status.'));
						}
					

				}
				else
				{
					echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
				}
				

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
	$edit_lname = strtoupper($_POST['edit_lname']);
	$edit_fname = strtoupper($_POST['edit_fname']);
	$edit_mname = strtoupper($_POST['edit_mname']);
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
		$query=mysqli_query($con,"UPDATE t_client SET BranchID = '$edit_branchid', FirstName = '$edit_fname', MiddleName = '$edit_mname', LastName = '$edit_lname', Birthday = '$edit_bday', ContactNo = '$edit_contactno', Address = '$edit_address', Email = '$edit_email', BusinessName = '$edit_bussName', BusinessAddress = '$edit_bussAdd', Gender = '$edit_gender', MaritalStatus = '$edit_maritalStatus', Age = '$edit_age', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND ClientID='$client_id')");

		if($query)
		{
				// Define the destination path based on $ClientID
				$path = '../../kyc_images/' . $client_id . '/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}

				$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

			$loop_count = 0;
			// Loop through the uploaded files
			foreach ($_FILES as $key => $value) {
				// Get the file details
				$imageView = ltrim($key, 'edit_');
				$tmpFile = $value['tmp_name'];
				$fileName = $value['name'];
				// Extract the file extension
				$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

				// Check if the file has a valid format
				if (in_array($ext, $valid_extensions)) {
					// Generate a unique name for each image
					$finalImgName = $imageView . '.' . $ext;
					$finalPath = $path . $finalImgName;

					// Move the uploaded file to the destination path
					if (move_uploaded_file($tmpFile, $finalPath)) {
						// The image has been successfully saved
						// You can add any additional processing or database operations here
						// echo "File '$fileName' has been uploaded and saved as '$finalImgName'.<br>";
						$loop_count ++;
					}
					//  else {
					// 	echo json_encode(array("statusCode"=>1,"message"=>'Error Uploading, Please Contact the IT Administrator!'));
					// 	// echo "Error uploading '$fileName'.<br>";
					// }
				} 
			}

			// Move the uploaded file to the destination path
			if ($loop_count == 2) {
				// The image has been successfully saved
				echo json_encode(array("statusCode"=>0,"message"=>'Update Complete!'));
			}
			 else {
				echo json_encode(array("statusCode"=>1,"message"=>'Error Uploading Photo, Please Contact the IT Administrator!'));
				// echo "Error uploading '$fileName'.<br>";
			}

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

		$query=mysqli_query($con,"UPDATE t_client SET StatusID = 'DEL' WHERE (id='$pk_id' AND ClientID='$client_id')");

		if($query)
		{
			$dirPath = '../../kyc_images/' . $client_id;

			if (! is_dir($dirPath)) {
				throw new InvalidArgumentException("$dirPath must be a directory");
			}
			if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
				$dirPath .= '/';
			}
			$files = glob($dirPath . '*', GLOB_MARK);
			foreach ($files as $file) {
				if (is_dir($file)) {
					self::deleteDir($file);
				} else {
					unlink($file);
				}
			}
			if(rmdir($dirPath)){
				echo json_encode(array("statusCode"=>0,"message"=>'Successfully Deleted!'));
			}
			else {
					echo json_encode(array("statusCode"=>1,"message"=>'Successfully Deleted but image retain!'));
				}

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

if($_POST['process']=='upload'){
$path = '../../kyc_images/';
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions

	if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
	{
	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{ 
	$path = $path.strtolower($final_image); 
	if(move_uploaded_file($tmp,$path)) 
	{
		echo json_encode(array("statusCode"=>0,"message"=>'Successfully saved!'.$path));
	}
	else
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator Image not save!'));
	}
	} 
	else 
	{
		echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
	}
	}

// // upload image 
// $uploadDirectory = '../../kyc_images/';

// if (!file_exists($uploadDirectory)) {
//     mkdir($uploadDirectory, 0777, true);
// }

// if (!empty($_FILES['image'])) {
// print_r($_FILES['image']);

//     $totalFiles = count($_FILES['image']['name']);

//     for ($i = 0; $i < $totalFiles; $i++) {
//         $tempFile = $_FILES['image']['tmp_name'][$i];
//         $targetFile = $uploadDirectory . $_FILES['image']['name'][$i];

//         // Check if the file already exists and rename it if necessary
//         $fileIndex = 0;
//         while (file_exists($targetFile)) {
//             $fileIndex++;
//             $newFileName = pathinfo($_FILES['image']['name'][$i], PATHINFO_FILENAME) . "_$fileIndex." . pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
//             $targetFile = $uploadDirectory . $newFileName;
//         }

//         if (move_uploaded_file($tempFile, $targetFile)) {
//             echo "File '{$_FILES['image']['name'][$i]}' uploaded successfully.<br>";
//         } else {
//             echo "Error uploading file '{$_FILES['image']['name'][$i]}'.<br>";
//         }
//     }
// } else {
//     echo "No files were uploaded.";
// }
}

?>

