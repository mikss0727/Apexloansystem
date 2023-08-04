// login
$(document).on('click','#login_btn',function(e) {


	var emp_id = document.getElementById("emp_id").value;
	var pass = document.getElementById("password").value;
    if (emp_id=='' || pass=='')
    {
        // alert("Required Fields are Empty");
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Required Fields are Empty!'
		})

    }
    else{
	 e.preventDefault()

		var data = $("#login_form").serialize();
		
			$.ajax({
				data: data,
				type: "post",
				url: "login/login_query.php",
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);

					if(dataResult.statusCode==0){
						
						Swal.fire({
							  icon: 'success',
							  title: 'Welcome to APEX FUNDING CORPORATION',
							  text: dataResult.message
							}).then(function() {
							    
							    	window.location.href = "pages/index.php";
							    
							    
							});
					}
					else if(dataResult.statusCode==1){
					   Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  text: dataResult.message
							})
					}
				}
			});
    }

});
