<?php
error_reporting(0);
include("../../database/connection.php");
require_once '../../assets/dompdf/autoload.inc.php';

if($_POST['process']=='getData'){
    $activeTab = $_POST['status'];
	
	$query = "SELECT 
				t1.id,
				t2.ClientID,
				t1.ApplicationNo,
				t2.LastName,
				t2.FirstName,
				t2.MiddleName,
				t1.BranchID,
				t3.BranchName,
				t1.ProductID,
				t4.ProductName,
				t4.LoanAmount,
				t4.TermID,
				t9.TermName,
				t9.TermNo,
				t1.TermType,
				t5.TypeName,
				t5.DaysNo,
				t1.InterestCode,
				t1.DisbursementDate,
				t1.StatusID,
				t1.LoanType,
				t1.ClosedDate,
				t1.CreatedAt,
				CONCAT(t6.LastName,', ',t6.FirstName,' ',t6.MiddleName) AS 'CreatedBy',
				t1.UpdatedAt,
				CONCAT(t7.LastName,', ',t7.FirstName,' ',t7.MiddleName) AS 'UpdatedBy',
				t8.RateName,
				t8.Rate
			FROM t_client_application t1 
			LEFT JOIN t_client t2
			ON t1.ClientID = t2.ClientID 
			LEFT JOIN t_branch t3
			ON t1.BranchID = t3.BranchID
			LEFT JOIN t_product t4
			ON t1.ProductID = t4.ProductID
			LEFT JOIN t_term_type t5
			ON t1.TermType = t5.TypeID
			LEFT JOIN t_employee t6
			ON t1.UpdatedBy = t6.EmployeeID
			LEFT JOIN t_employee t7
			ON t1.UpdatedBy = t7.EmployeeID
			LEFT JOIN t_interest_rate t8
			ON t1.InterestCode = t8.RateID
			LEFT JOIN t_product_term t9
			ON t4.TermID = t9.TermID
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

// get schedule
if($_POST['process']=='getSchedule'){
    $application_no = $_POST['application_no'];
    $branch = $_POST['branch'];
    $product_id = $_POST['product_id'];

	$query = "SELECT
					t1.ApplicationNo,
					t1.BranchID,
					t1.ProductCode,
					t1.InstallmentNo,
					t1.InstallmentAmount,
					t1.Balance,
					t1.DueDate,
					t1.StatusID,
					t2.StatusName,
					t1.PostRemarks,
					t1.ConfirmRemarks,
					CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'PostedBy',
					CONCAT(t4.LastName,', ',t4.FirstName,' ',t4.MiddleName) AS 'ConfirmBy',
					t1.PostedAt,
					t1.ConfirmAt
			FROM t_loan_schedule t1
			LEFT JOIN t_status t2
			ON t2.StatusID = t1.StatusID
			LEFT JOIN t_employee t3
			ON t1.PostedBy = t3.EmployeeID
			LEFT JOIN t_employee t4
			ON t1.ConfirmBy = t4.EmployeeID
			WHERE t1.ApplicationNo = ? AND t1.BranchID = ? AND t1.ProductCode = ?
			ORDER BY t1.InstallmentNo ASC";

				$stmt = mysqli_prepare($con, $query);
				mysqli_stmt_bind_param($stmt, "sss", $application_no, $branch, $product_id);
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


// edit Application
if($_POST['process']=='editApplication'){

	$pk_id = $_POST['pk_id'];
    $EmployeeID = $_POST['EmployeeID'];
	$applicaiton_no = $_POST['a_application_no'];
	$product_id = $_POST['a_loan_product'];
	$interest_code = $_POST['a_loan_rate'];
	$term_type = $_POST['a_loan_term_type'];
	$disb_date = $_POST['a_loan_disbDate'];


	$query_check=mysqli_query($con,"SELECT * FROM t_client_application WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_client_application SET ProductID = '$product_id', InterestCode = '$interest_code', TermType = '$term_type', DisbursementDate = '$disb_date', UpdatedAt = NOW(), UpdatedBy = '$EmployeeID'
		WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no')");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Update Application Complete!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Update Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Application Does Not Exist!'));


		
	}

}



// approved Application
if($_POST['process']=='processApplication'){

	$pk_id = $_POST['v_pk_id'];
    $EmployeeID = $_POST['EmployeeID'];
    $status = $_POST['v_loan_status'];
	$applicaiton_no = $_POST['v_application_no'];
	$client_id = $_POST['v_clientID'];
	$remarks = $_POST['remarks'];


	switch ($status) {
		case "APR":
			$ProcessValue = 'Approved';
			$ApplicationStatus = 'FORDISB';
			break;
		case "REJ":
			$ProcessValue = 'Rejected';
			$ApplicationStatus = 'REJ';
			break;
		case "CNCL":
			$ProcessValue = 'Cancelled';
			$ApplicationStatus = 'CNCL';
			break;
		default:
			$ProcessValue = '';

	}

	$query_check=mysqli_query($con,"SELECT * FROM t_client_application WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no')");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

		
		// update
		$query=mysqli_query($con,"UPDATE t_client_application SET StatusID = '$ApplicationStatus' WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no' AND ClientID = '$client_id')");

		if($query)
		{
			$query_countProcess=mysqli_query($con,"SELECT COUNT(ApplicationNo) AS process_count FROM t_applicationprocess WHERE ApplicationNo = '$applicaiton_no'");
			$row = mysqli_fetch_assoc($query_countProcess);
			$lastCount = $row['process_count'] ?? 0;

			// Generate a new process number
			$newCount = $lastCount + 1;

			// add application process
			$query_addProcess=mysqli_query($con,"INSERT INTO t_applicationprocess (ApplicationNo, ProcessNo, StatusID, ProcessValue, Remarks, ProcessBy, CreatedAt) VALUES ('$applicaiton_no','$newCount','$status','$ProcessValue','$remarks','$EmployeeID',NOW())");

			echo json_encode(array("statusCode"=>0,"message"=>'Application Process Complete!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Update Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Application Does Not Exist!'));


		
	}

}


// disbursed client Application
if($_POST['process']=='DisburseClient'){
		$client_data = json_decode($_POST['client_data'], true); // Decode the JSON string into a PHP array
		$installments = json_decode($_POST['paymentSchedule'], true); // Decode the JSON string into a PHP array
		$applicaiton_no = $client_data['applicationNo'];
		$pk_id = $client_data['pk_id'];
		$client_id = $client_data['clientID'];

		// echo $client_data['applicationNo']	 . "<br>";
		// echo $client_data['branch_id']	 . "<br>";
		// echo $client_data['product_id']	 . "<br>";
		// echo $sched['installment']	 . "<br>"; // Output each element followed by a line break
		// echo $sched['payment']	 . "<br>"; // Output each element followed by a line break
		// echo $sched['balance']	 . "<br>"; // Output each element followed by a line break
		// echo $due_date . "<br>"; // Output each element followed by a line break

		
	$query_check=mysqli_query($con,"SELECT * FROM t_client_application WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no') AND StatusID = 'FORDISB'");
	$num_rows=mysqli_num_rows($query_check);
	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_client_application SET StatusID = 'DISB' WHERE (id='$pk_id' AND ApplicationNo='$applicaiton_no' AND ClientID = '$client_id')");

		if($query)
		{
				
			// SQL query to insert data into a table 
			$sql = "INSERT INTO t_loan_schedule (ApplicationNo, BranchID, ProductCode, InstallmentNo, InstallmentAmount, Balance, DueDate, StatusID, CreatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

			// Prepare the SQL statement
			$stmt = $con->prepare($sql);

			if ($stmt === false) {
				die("Error preparing statement: " . $con->error);
			}

			// Initialize a success variable
			$success = true;

			// Bind parameters and execute the statement for each data entry
			foreach ($installments as $data) {
				$timestamp = strtotime($data['dueDate']);
				$due_date = date("Y-m-d", $timestamp);

				$applicationNo = $client_data['applicationNo'];
				$branch_id = $client_data['branch_id'];
				$product_id = $client_data['product_id'];
				$installment_no = $data['installment'];
				$payment_amount = $data['payment'];
				$balance = $data['balance'];
				$status_id = 'PND';
				// Bind parameters
				$stmt->bind_param("ssssssss", $applicationNo, $branch_id, $product_id, $installment_no, $payment_amount, $balance, $due_date, $status_id);
				
				// Execute the statement
				if ($stmt->execute() === false) {
					$success = false;
					echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'. $stmt->error));
					break; // Exit the loop on the first failure
				}
				
				// Reset parameter bindings for the next iteration
				$stmt->reset();
			}

			// Close the prepared statement
			$stmt->close();

					
					
			// Provide a success message
			if ($success) {
				
				$query_countProcess=mysqli_query($con,"SELECT COUNT(ApplicationNo) AS process_count FROM t_applicationprocess WHERE ApplicationNo = '$applicaiton_no'");
				$row = mysqli_fetch_assoc($query_countProcess);
				$lastCount = $row['process_count'] ?? 0;

				// Generate a new process number
				$newCount = $lastCount + 1;

				// add application process
				$query_addProcess=mysqli_query($con,"INSERT INTO t_applicationprocess (ApplicationNo, ProcessNo, StatusID, ProcessValue, Remarks, ProcessBy, CreatedAt) VALUES ('$applicaiton_no','$newCount','DISB','Disbursed','Client Disbursed','$EmployeeID',NOW())");

				if($query_addProcess){
					// echo json_encode(array("statusCode"=>0,"message"=>'Client Disbursed Successfully!'));
					$GeneratePDF = generateAndSavePDF($client_data, $installments);

										
					if ($GeneratePDF !== false) {
						echo json_encode(array("statusCode"=>0,"message"=>'PDF generation and saving successful. File: ' . $GeneratePDF));
					} else {
						echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator! PDF generation and saving failed.'));

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
			echo json_encode(array("statusCode"=>1,"message"=>'Update Error, Please Contact the IT Administrator!'));
		}
			
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Application Does Not Exist or Already disbursed!'));

	}

	
	
}	



// postPayment 
if($_POST['process']=='postPayment'){

    $EmployeeID = $_POST['EmployeeID'];
	$applicaiton_no = $_POST['postApplicationNo'];
	$remarks = $_POST['postRemarks'];
	$product_code = $_POST['postProductCode'];
	$branch_code = $_POST['postBranchID'];
	$installment_no = $_POST['postInstallmentNo'];



	$query_check=mysqli_query($con,"SELECT * FROM t_loan_schedule WHERE (ApplicationNo='$applicaiton_no' AND BranchID = '$branch_code' AND ProductCode = '$product_code' AND InstallmentNo = '$installment_no' AND StatusID = 'PND')");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_loan_schedule SET StatusID = 'OP', PostRemarks = '$remarks', PostedBy = '$EmployeeID', PostedAt = NOW() WHERE ApplicationNo='$applicaiton_no' AND BranchID = '$branch_code' AND ProductCode = '$product_code' AND InstallmentNo = '$installment_no' AND StatusID = 'PND'");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Payment in Installment No '.$installment_no.'has been Successfully Posted, Kindly wait for the BM to Confirm the Payment!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Amortization with Installment No '.$installment_no.' is not Pending in Payment!'));
		
	}

}
// end post payment 




// confirm Payment 
if($_POST['process']=='confirmPayment'){

    $EmployeeID = $_POST['EmployeeID'];
	$applicaiton_no = $_POST['confirmApplicationNo'];
	$remarks = $_POST['confirmRemarks'];
	$product_code = $_POST['confirmProductCode'];
	$branch_code = $_POST['confirmBranchID'];
	$installment_no = $_POST['confirmInstallmentNo'];



	$query_check=mysqli_query($con,"SELECT * FROM t_loan_schedule WHERE (ApplicationNo='$applicaiton_no' AND BranchID = '$branch_code' AND ProductCode = '$product_code' AND InstallmentNo = '$installment_no' AND StatusID = 'OP')");
	$num_rows=mysqli_num_rows($query_check);

	if($num_rows)
	{

			// update
		$query=mysqli_query($con,"UPDATE t_loan_schedule SET StatusID = 'PAID', ConfirmRemarks = '$remarks', ConfirmBy = '$EmployeeID', ConfirmAt = NOW() WHERE ApplicationNo='$applicaiton_no' AND BranchID = '$branch_code' AND ProductCode = '$product_code' AND InstallmentNo = '$installment_no' AND StatusID = 'OP'");

		if($query)
		{
			echo json_encode(array("statusCode"=>0,"message"=>'Payment for Installment No '.$installment_no.' Confirm Successfully!'));

		}
		else
		{
			echo json_encode(array("statusCode"=>1,"message"=>'Error, Please Contact the IT Administrator!'));
		}
		
	}
	else
	{

		echo json_encode(array("statusCode"=>1,"message"=>'Amortization with Installment No '.$installment_no.' is not Posted!'));
		
	}

}
// end confirm payment 

use Dompdf\Dompdf;
use Dompdf\Options;

function generateAndSavePDF($client_data, $installments){

		$appno = $client_data['applicationNo'];
		$name = $client_data['clientName'];
		$branch = $client_data['branch_name'];
		$clientid = $client_data['clientID'];
		$loan_amount = number_format($client_data['loan_amount'], 2, '.', ',');
		$disbDate = date("F j, Y", (strtotime($client_data['disbDate'])));		
		$filename = $client_data['applicationNo'].'.pdf';

			// pre define name 
		$branch_manager = 'Miko Angelo Coronado';
		

	
	/**
	 * Set the Dompdf options
	 */
	$options = new Options;
	$options->setChroot(__DIR__);
	$options->setIsRemoteEnabled(true);
	$options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
	$options->set('isPhpEnabled', true); // Enable PHP parsing
	$options->set('isPhpEnabled', true); // Enable image handling

	$dompdf = new Dompdf($options);

	/**
	 * Set the paper size and orientation
	 */
	// $dompdf->setPaper("A4", "landscape");

	/**
	 * Load the HTML and replace placeholders with values from the form
	 */
	$html = file_get_contents("../template/schedule_template.html");

	// $html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $appno], $html);
		
		
	// Replace the placeholder in the HTML with the installment data
	$tableRows = '';
	foreach ($installments as $installment) {
		$tableRows .= '<tr>';
		$tableRows .= '<td>' . $installment['installment'] . '</td>';
		$tableRows .= '<td>' . $installment['dueDate'] . '</td>';
		$tableRows .= '<td>' . number_format($installment['balance'], 2, '.', ',') . '</td>';
		$tableRows .= '<td>' . number_format($installment['payment'], 2, '.', ',') . '</td>';
		$tableRows .= '<td>_______________________________</td>';
		$tableRows .= '</tr>';
	}
	// $html = str_replace(["{{ INSTALLMENT_TABLE }}", "{{ CLIENT_NAME }}"], [$tableRows, $name], $html);
	$html = str_replace('{{INSTALLMENT_TABLE}}', $tableRows, $html);
	$html = str_replace('{{CLIENT_NAME}}', $name, $html);
	$html = str_replace('{{APPLICATION_NO}}', $appno, $html);
	$html = str_replace('{{DISB_DATE}}', $disbDate, $html);
	$html = str_replace('{{BRANCH}}', $branch, $html);
	$html = str_replace('{{BRANCH_MANAGER}}', $branch_manager, $html);
	$html = str_replace('{{LOAN_AMOUNT}}', $loan_amount, $html);
	$html = str_replace('{{CLIENT_ID}}', $clientid, $html);

// print_r($installments);


	$dompdf->loadHtml($html);
	//$dompdf->loadHtmlFile("template.html");

	/**
	 * Create the PDF and set attributes
	 */
	$dompdf->render();

	$dompdf->addInfo("Title", "Apexloan Installment PDF"); // "add_info" in earlier versions of Dompdf

	/**
	 * Send the PDF to the browser
	 */
	// $dompdf->stream($name . "invoice.pdf", ["Attachment" => 0]);

	/**
	 * Save the PDF file locally
	 */
	$output = $dompdf->output();

	// Specify the folder path and file name.
	$folder_path = '../../LoanSchedule/'.$appno; // Change this to your desired folder path.
	$file_name = $filename;

	// Ensure the folder exists or create it if it doesn't.
	if (!is_dir($folder_path)) {
		// Create the folder with permissions (you can adjust these as needed).
		mkdir($folder_path, 0777, true);
	}

	// Combine the folder path and file name to get the full file path.
	$file_path = $folder_path . '/' . $file_name;

	// Content you want to write to the file.
	$file_content = $output;
	file_put_contents($file_path, $file_content);

	 // Write the PDF content to the file
	 if (file_put_contents($file_path, $file_content) === false) {
        // Unable to write the file, return false to indicate failure
        return false;
    }
	
	 // Return the full file path for reference
	 return $file_name;
}

// for test purposes only  
// if($_POST['process']=='GeneratePdf'){

// 		$client_data = json_decode($_POST['client_data'], true); // Decode the JSON string into a PHP array
// 		$installments = json_decode($_POST['paymentSchedule'], true); // Decode the JSON string into a PHP array
// 		$appno = $client_data['applicationNo'];
// 		$name = $client_data['clientName'];
	//  $clientid = $client_data['clientID'];
	//  $loan_amount = number_format($client_data['loan_amount'], 2, '.', ',');
// 		$disbDate = date("F j, Y", (strtotime($client_data['disbDate'])));
// 		$branch = $client_data['branch_name'];
// 		$filename = $client_data['applicationNo'].'.pdf';

// 			// pre define name 
// 		$branch_manager = 'Miko Angelo Coronado';
	
// 	/**
// 	 * Set the Dompdf options
// 	 */
// 	$options = new Options;
// 	$options->setChroot(__DIR__);
// 	$options->setIsRemoteEnabled(true);
// 	$options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
// 	$options->set('isPhpEnabled', true); // Enable PHP parsing
// 	$options->set('isPhpEnabled', true); // Enable image handling

// 	$dompdf = new Dompdf($options);

// 	/**
// 	 * Set the paper size and orientation
// 	 */
// 	// $dompdf->setPaper("A4", "landscape");

// 	/**
// 	 * Load the HTML and replace placeholders with values from the form
// 	 */
// 	$html = file_get_contents("../template/schedule_template.html");

// 	// $html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $appno], $html);
		
		
// 	// Replace the placeholder in the HTML with the installment data
// 	$tableRows = '';
// 	foreach ($installments as $installment) {
// 		$tableRows .= '<tr>';
// 		$tableRows .= '<td>' . $installment['installment'] . '</td>';
// 		$tableRows .= '<td>' . $installment['dueDate'] . '</td>';
// 		$tableRows .= '<td>' . $installment['balance'] . '</td>';
// 		$tableRows .= '<td>' . $installment['payment'] . '</td>';
// 		$tableRows .= '<td>_______________________________</td>';
// 		$tableRows .= '</tr>';
// 	}
// 	// $html = str_replace(["{{ INSTALLMENT_TABLE }}", "{{ CLIENT_NAME }}"], [$tableRows, $name], $html);
// 	$html = str_replace('{{INSTALLMENT_TABLE}}', $tableRows, $html);
// 	$html = str_replace('{{CLIENT_NAME}}', $name, $html);
// 	$html = str_replace('{{APPLICATION_NO}}', $appno, $html);
// 	$html = str_replace('{{DISB_DATE}}', $disbDate, $html);
// 	$html = str_replace('{{BRANCH}}', $branch, $html);
// 	$html = str_replace('{{BRANCH_MANAGER}}', $branch_manager, $html);
// $html = str_replace('{{LOAN_AMOUNT}}', $loan_amount, $html);
// $html = str_replace('{{CLIENT_ID}}', $clientid, $html);
// // print_r($installments);


// 	$dompdf->loadHtml($html);
// 	//$dompdf->loadHtmlFile("template.html");

// 	/**
// 	 * Create the PDF and set attributes
// 	 */
// 	$dompdf->render();

// 	$dompdf->addInfo("Title", "Apexloan Installment PDF"); // "add_info" in earlier versions of Dompdf


// 	/**
// 	 * Send the PDF to the browser
// 	 */
// 	// $dompdf->stream($name . "invoice.pdf", ["Attachment" => 0]);

// 	/**
// 	 * Save the PDF file locally
// 	 */
// 	$output = $dompdf->output();

// 	// Specify the folder path and file name.
// 	$folder_path = '../../LoanSchedule/'.$appno; // Change this to your desired folder path.
// 	$file_name = $filename;

// 	// Ensure the folder exists or create it if it doesn't.
// 	if (!is_dir($folder_path)) {
// 		// Create the folder with permissions (you can adjust these as needed).
// 		mkdir($folder_path, 0777, true);
// 	}

// 	// Combine the folder path and file name to get the full file path.
// 	$file_path = $folder_path . '/' . $file_name;

// 	// Content you want to write to the file.
// 	$file_content = $output;
// 	file_put_contents($file_path, $file_content);

// }
?>

