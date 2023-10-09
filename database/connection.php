<?php

	// format
	//mysqli_connect(host,username,password,dbname,port,sockets);
	//mysqli_select_db(connection,dbname);
	
	$host="localhost";
	$username="u277381793_ApexFunding";
	$password="P@ssword1";
	// $username="root";
	// $password="";
	$err1="Error Can't connect to MySQL";
	$err2="Error Can't connect to Database";
	
	
	$con=mysqli_connect($host,$username,$password) or die ($err1);
	mysqli_select_db($con,'u277381793_ApexLoanDb') or die ($err2);
	// mysqli_select_db($con,'loandb') or die ($err2);
	
	?>
    
	
