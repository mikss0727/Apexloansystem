
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}
// Accept number only 
function validateDecimalInput(input) {
    input.value = input.value.replace(/\D/g, '');

    const maxLength = 11;
  
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);

        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Only 11 numbers required!'
          })
    }
}


function ValidationFeedback(form) {
    const inputFields = form.querySelectorAll('.form-control');
    const validFeedbackList = form.querySelectorAll('.valid-feedback');
    const invalidFeedbackList = form.querySelectorAll('.invalid-feedback');

    let allFieldsValid = true;

    inputFields.forEach((inputField, index) => {
            if(inputField.name == 'add_contactno'){
                if(inputField.value.length != 11){
                    validFeedbackList[index].style.display = 'none';
                    invalidFeedbackList[index].style.display = 'block';
                    allFieldsValid = false;
                }
                else{
                    validFeedbackList[index].style.display = 'block';
                    invalidFeedbackList[index].style.display = 'none';
                }
            }
            else{
                if (inputField.validity.valid) {
                    validFeedbackList[index].style.display = 'block';
                    invalidFeedbackList[index].style.display = 'none';
                } else {
                    validFeedbackList[index].style.display = 'none';
                    invalidFeedbackList[index].style.display = 'block';
                    allFieldsValid = false;
                }
            }
    
    });
    return allFieldsValid;
}

document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// view Employee
	$(document).on('click','#viewEmployee',function(e) {
		
		$('#tbl_employee').hide();
		$('#view_employee').show();

		
		var v_employeeID = $(this).attr("data-employee_id");
		var v_employeeName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var v_dept = $(this).attr("data-dept_name");
		var v_pos = $(this).attr("data-pos_name");
		var v_bday = $(this).attr("data-birthday");
		var v_contactno = $(this).attr("data-contact_no");
		var v_email = $(this).attr("data-email");
		if($(this).attr("data-isActive") == 0){
			var v_status = 'Active'
		}
		else{
			var v_status = 'Inactive'
		};


		$('#v_employeeID').val(v_employeeID);
		$('#v_employeeName').val(v_employeeName);
		$('#v_dept').val(v_dept);
		$('#v_pos').val(v_pos);
		$('#v_bday').val(v_bday);
		$('#v_contactno').val(v_contactno);
		$('#v_email').val(v_email);
		$('#v_status').val(v_status);
		
	});



	// show hide div
	$(document).on('click','#back',function(e) {
		// get data in form
		$('#tbl_employee').show();
		$('#view_employee').hide();
		
	});

	// show hide div
	$(document).on('click','#addEmployee',function(e) {
		
		$('#tbl_employee').hide();
		$('#add_employee').show();

		
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_employee').show();
		$('#add_employee').hide();
		
	});

	// add employee submit
	$("#addEmployee_form").submit(function(e) {
        e.preventDefault();
        // validate form
        const form = document.getElementById("addEmployee_form");
	
        if (!ValidationFeedback(form)) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Some fields are empty or does not meet the condition!'
				})
        } else {
            

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Continue!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var data = $("#addEmployee_form").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "sql/employee-sql-query.php",
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);

                            if(dataResult.statusCode==0){
                                
                                $('#add_employee').hide();
                                $('#tbl_employee').show();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success...',
                                        text: dataResult.message
                                    }).then(function() {
                                        window.location = 'employee.php';
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
            })

        }
	});


	// edit employee
	$(document).on('click','#editEmployee',function(e) {

		$('#tbl_employee').hide();
		$('#edit_employee').show();

		var pk_id = $(this).attr("data-pk_id");
		var employee_id = $(this).attr("data-employee_id");
		var edit_lname = $(this).attr("data-last_name");
		var edit_fname = $(this).attr("data-first_name");
		var edit_mname = $(this).attr("data-middle_name");
		var edit_bday = $(this).attr("data-birthday");
		var edit_contactno = $(this).attr("data-contact_no");
		var edit_email = $(this).attr("data-email");
		var edit_deptID = $(this).attr("data-dept_id");
		var edit_posID = $(this).attr("data-pos_id");
		var edit_isActive = $(this).attr("data-isactive");


        // Convert to Date object
        var parsedDate = new Date(edit_bday);

        // Format the date as "yyyy-MM-dd"
        var formattedDate = parsedDate.toISOString().split('T')[0];



		$('#pk_id').val(pk_id);
		$('#employee_id').val(employee_id);
		$('#edit_lname').val(edit_lname);
		$('#edit_fname').val(edit_fname);
		$('#edit_mname').val(edit_mname);
		$('#edit_bday').val(formattedDate);
		$('#edit_contactno').val(edit_contactno);
		$('#edit_email').val(edit_email);
		$('#edit_deptID').val(edit_deptID);
		$('#edit_posID').val(edit_posID);
		$('#edit_isActive').val(edit_isActive);

		reloadSelectUi();
	});

    // show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
        $('#tbl_employee').show();
		$('#edit_employee').hide();
		
	});


	// edit employee submit
	$("#employeeEdit_form").submit(function(e) {
		e.preventDefault();
        // validate form
        const form = document.getElementById("employeeEdit_form");
	
        if (!ValidationFeedback(form)) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Some fields are empty or does not meet the condition!'
				})
        }
		else{

			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Continue!'
			}).then((result) => {
				if (result.isConfirmed) {
					
					var data = $("#employeeEdit_form").serialize();
					
					$.ajax({
						data: data,
						type: "post",
						url: "sql/employee-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'employee.php';
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
			})
		}	
	});

	// delete Employee
	$(document).on('click','#deleteEmployee',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var employee_id=$(this).attr("data-employee_id");

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Continue!'
		}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
					data:{
						process:'deleteEmployee',
						pk_id: pk_id,
						employee_id: employee_id
					},
					type: "post",
					url: "sql/employee-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'employee.php';
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
		})
	});


});