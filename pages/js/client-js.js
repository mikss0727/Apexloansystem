// global variable 
var activeTabValue = '';

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


// age limit
const ageLimit = 65;

// calculate age add
const birthdateInputAdd = document.getElementById("add_bday");

birthdateInputAdd.addEventListener("input", calculateAgeAdd);

function calculateAgeAdd() {
	const birthdateValue = new Date(birthdateInputAdd.value);
	var result = calculateAge(birthdateValue);

	if((result < 19) || (result > ageLimit)){
		Swal.fire({
            icon: 'info',
            title: 'Ooops...',
            text: 'Age must be greater than 19yrs and less than 65yrs!'
          })
		 // Get the date input element by its ID
		 const datePicker = document.getElementById('add_bday');

		 // Set the value of the date input to be empty (null)
		 datePicker.value = '';
	}
	else{
		$('#add_age').val(result);
	}
    
  }

  
// calculate age edit
const birthdateInputEdit = document.getElementById("edit_bday");

birthdateInputEdit.addEventListener("input", calculateAgeEdit);

function calculateAgeEdit() {
	const birthdateValue = new Date(birthdateInputEdit.value);
	var result = calculateAge(birthdateValue);

	if((result < 19) || (result > ageLimit)){
		Swal.fire({
            icon: 'info',
            title: 'Ooops...',
            text: 'Age must be greater than 19yrs and less than 65yrs!'
          })
		 // Get the date input element by its ID
		 const datePicker = document.getElementById('edit_bday');

		 // Set the value of the date input to be empty (null)
		 datePicker.value = '';
	}
	else{
		$('#edit_age').val(result);
	}
    
  }



function calculateAge(request) {
    const today = new Date();
  
    let years = today.getFullYear() - request.getFullYear();
    const months = today.getMonth() - request.getMonth();
    const days = today.getDate() - request.getDate();

    if (months < 0 || (months === 0 && days < 0)) {
      years --;
    }
	return years;
    
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

	// view client
	$(document).on('click','#viewClient',function(e) {
		
		$('#tbl_client').hide();
		$('#view_client').show();

		
		var v_pkID = $(this).attr("data-pk_id");
		var v_clientID = $(this).attr("data-client_id");
		var v_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var v_branch = $(this).attr("data-branch_id")+' - '+$(this).attr("data-branch_name");
		var v_bday = $(this).attr("data-birthday");
		var v_age = $(this).attr("data-age");
		var v_contactno = $(this).attr("data-contact_no");
		var v_address = $(this).attr("data-address");
		var v_email = $(this).attr("data-email");
		var v_bussName = $(this).attr("data-business_name");
		var v_bussAdd = $(this).attr("data-business_address");
		if($(this).attr("data-gender") == 'F'){
			var v_gender = 'Female'
		}
		else{
			var v_gender = 'Male'
		};
		var v_maritalStatus = $(this).attr("data-marital_name");
		var v_status = $(this).attr("data-status_name");
		var v_statusID = $(this).attr("data-status_id");


		$('#p_pk_id').val(v_pkID);
		$('#p_client_id').val(v_clientID);
		$('#v_statusID').val(v_statusID);
		$('#v_clientID').val(v_clientID);
		$('#v_clientName').val(v_clientName);
		$('#v_branch').val(v_branch);
		$('#v_bday').val(v_bday);
		$('#v_age').val(v_age);
		$('#v_contactno').val(v_contactno);
		$('#v_address').val(v_address);
		$('#v_email').val(v_email);
		$('#v_bussName').val(v_bussName);
		$('#v_bussAdd').val(v_bussAdd);
		$('#v_gender').val(v_gender);
		$('#v_maritalStatus').val(v_maritalStatus);
		$('#v_status').val(v_status);
		
	});

	// approved client button
	$("#clientApproval_form").submit(function(e) {
        e.preventDefault();
		var data = $("#clientApproval_form").serialize();
		console.log(data);
	
		var p_statusID = document.getElementById("v_statusID").value;

		if (p_statusID =='' || p_statusID ==null || p_statusID =='PND')
		{
			e.preventDefault();

			// alert("Please Fill All Required Field");
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Status must be Approved or Reject Only!'
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

					var data = $("#clientApproval_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/client-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#view_client').hide();
								$('#tbl_client').show();

									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'client.php';
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

		// show hide div
		$(document).on('click','#reject_client',function(e) {
			// get data in form
			var data = $("#clientApproval_form").serialize();

		console.log(data);
		});


	// show hide div
	$(document).on('click','#back',function(e) {
		// get data in form
		$('#tbl_client').show();
		$('#view_client').hide();
		
	});

	// show hide div
	$(document).on('click','#addClient',function(e) {
		
		$('#tbl_client').hide();
		$('#add_client').show();

		
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_client').show();
		$('#add_client').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_client').show();
		$('#edit_client').hide();
		
	});

	// add user submit
	$("#addClient_form").submit(function(e) {
        e.preventDefault();
        // validate form
        const form = document.getElementById("addClient_form");
	
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

                    var data = $("#addClient_form").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "sql/client-sql-query.php",
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);

                            if(dataResult.statusCode==0){
                                
                                $('#add_client').hide();
                                $('#tbl_client').show();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success...',
                                        text: dataResult.message
                                    }).then(function() {
                                        window.location = 'client.php';
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


	// edit client
	$(document).on('click','#editClient',function(e) {

		$('#tbl_client').hide();
		$('#edit_client').show();

		var pk_id = $(this).attr("data-pk_id");
		var client_id = $(this).attr("data-client_id");
		var status_id = $(this).attr("data-status_id");
		var edit_lname = $(this).attr("data-last_name");
		var edit_fname = $(this).attr("data-first_name");
		var edit_mname = $(this).attr("data-middle_name");
		var edit_branchid = $(this).attr("data-branch_id");
		var edit_bday = $(this).attr("data-birthday");
		var edit_contactno = $(this).attr("data-contact_no");
		var edit_address = $(this).attr("data-address");
		var edit_email = $(this).attr("data-email");
		var edit_bussName = $(this).attr("data-business_name");
		var edit_bussAdd = $(this).attr("data-business_address");
		var edit_gender = $(this).attr("data-gender");
		var edit_age = $(this).attr("data-age");
		var edit_maritalStatus = $(this).attr("data-marital_status");



		$('#pk_id').val(pk_id);
		$('#client_id').val(client_id);
		$('#status_id').val(status_id);
		$('#edit_lname').val(edit_lname);
		$('#edit_fname').val(edit_fname);
		$('#edit_mname').val(edit_mname);
		$('#edit_branchid').val(edit_branchid);
		$('#edit_bday').val(edit_bday);
		$('#edit_contactno').val(edit_contactno);
		$('#edit_address').val(edit_address);
		$('#edit_email').val(edit_email);
		$('#edit_bussName').val(edit_bussName);
		$('#edit_bussAdd').val(edit_bussAdd);
		$('#edit_gender').val(edit_gender);
		$('#edit_age').val(edit_age);
		$('#edit_maritalStatus').val(edit_maritalStatus);
	});


	// edit user submit
	$("#clientEdit_form").submit(function(e) {
		e.preventDefault();
        // validate form
        const form = document.getElementById("clientEdit_form");
	
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
					
					var data = $("#clientEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/client-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'client.php';
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

	// delete position
	$(document).on('click','#deleteClient',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var client_id=$(this).attr("data-client_id");

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
						process:'deleteClient',
						pk_id: pk_id,
						client_id: client_id
					},
					type: "post",
					url: "sql/client-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'client.php';
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



// 	function activeTab(tabClass) {
// 		console.log('.'+tabClass);
// 		console.log($(this));
	
// 		$('.'+tabClass).removeClass('active'); // Remove active class from all tabs
// 		$(this).addClass('active'); // Add active class to clicked tab
		
// 		var tabValue = $(this).data('value');
// 		console.log(tabValue);
		
// 	  }

// // tab 
// 	$('.client-tab').click(function () {
// 		activeTab('client-tab');
		
// 	});

	$(document).ready(function () {
		
		// Set active tab on page load (you can choose a default active tab)
		$('.client-tab[data-value="tab1"]').addClass('active');
		activeTabValue = $('.client-tab.active').data('value');
		
			$.ajax({
				data:{
					statusID:'deleteMarital',
				},
				type: "post",
				url: "client.php",
				success: function(response){
					// Process the response from the PHP script if needed
					console.log(response);
				}
			});

		// Handle tab click
		$('.client-tab').click(function () {
			$('.client-tab').removeClass('active'); // Remove active class from all tabs
			$(this).addClass('active'); // Add active class to clicked tab
			
			activeTabValue = $(this).data('value');
			$.ajax({
				data:{
					statusID:'deleteMarital',
				},
				type: "post",
				url: "client.php",
				success: function(response){
					// Process the response from the PHP script if needed
					console.log(response);
				}
			});
		});

		
	});
	

});