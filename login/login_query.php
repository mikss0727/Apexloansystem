<?php
error_reporting(0);

include("../database/connection.php");

	// login
	if($_POST['process']=='login'){

		$emp_id=$_POST['emp_id'];
		$password=$_POST['password'];


		// convert the password to md5
		$password_hash=md5(md5($emp_id.$password."apex"));

		
		$query_login=mysqli_query($con,"SELECT 
											t1.EmployeeID,
											t1.RoleID,
											t1.BranchID,
											CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'Name',
											t2.DeptID,
											t2.PositionID,
											t3.DeptName,
											t4.PositionName,
											t1.isActive
										FROM t_user_account t1
										LEFT JOIN t_employee t2
										ON t1.EmployeeID = t2.EmployeeID
										LEFT JOIN t_department t3
										ON t2.DeptID = t3.DeptID
										LEFT JOIN t_position t4
										ON t2.PositionID = t4.PositionID
										LEFT JOIN t_branch t5
										ON t1.BranchID = t5.BranchName
										WHERE t1.EmployeeID='$emp_id' && t1.Password='$password_hash'");

		$check_acount=mysqli_num_rows($query_login);
	
		while($fetch=mysqli_fetch_assoc($query_login))
			{
				$EmployeeID=$fetch['EmployeeID'];
				$Name=$fetch['Name'];
				$RoleID=$fetch['RoleID'];
				$BranchID=$fetch['BranchID'];
				$DeptID=$fetch['DeptID'];
				$PositionID=$fetch['PositionID'];
				$DeptName=$fetch['DeptName'];
				$PositionName=$fetch['PositionName'];
				$isActive=$fetch['isActive'];

			}



			if($check_acount)
			{
				session_start();
				$_SESSION['EmployeeID']=$EmployeeID;		
				$_SESSION['Name']=$Name;		
				$_SESSION['RoleID']=$RoleID;	
				$_SESSION['BranchID']=$BranchID;	
				$_SESSION['DeptID']=$DeptID;		
				$_SESSION['PositionID']=$PositionID;	
				$_SESSION['DeptName']=$DeptName;		
				$_SESSION['PositionName']=$PositionName;	
				$_SESSION['isActive']=$isActive;

				if ($isActive == 1) {
					echo json_encode(array("statusCode"=>1,"message"=>'Your Account Status is Inactive. Please Contact Your System Administrator!'));
					
				}
				else{
					echo json_encode(array("statusCode"=>0,"message"=>'Login Successfully!'));

				}
			}
			else
			{

				echo json_encode(array("statusCode"=>1,"message"=>'Employee ID Does Not Exist!'));
				
			}
		
		
	

	}

?>