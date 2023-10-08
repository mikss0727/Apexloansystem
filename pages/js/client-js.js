
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

  
 // Function to validate the selected image
 function validateImage(inputID) {
	const imageInput = document.getElementById(inputID);
	
	// Check if an image is selected
	if (imageInput.files.length === 0) {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'No Image Selected!'
		  })
	}
	else{


	// Get the selected image file
	const selectedImage = imageInput.files[0];
	// Check if the file type is an image
	if (!selectedImage.type.startsWith('image/')) {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Please Check the Image Type!',
			footer: 'Image Type Must be .jpg or .jpeg'
		  })
		clearInputField(imageInput);
		
	}
}


}

	// Close the modal 
	function closeModal(id) {
		const modal = document.getElementById(id);
		modal.style.display = 'none';
		modal.style.opacity = '0';

	}


// Function to clear the input field
function clearInputField(inputField) {
	inputField.value = ''; // Clear the selected file
}

//   form validation 
function CustomValidationFeedback(form) {
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
			else if((inputField.name == 'ID_FRONT') || (inputField.name == 'ID_BACK')){
                if(inputField.files.length === 0){
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
		reloadSelectUi();
	});


	// Apply loan Button 
	$(document).on('click','#applyLoan',function(e) {
		
		$('#tbl_client').hide();
		$('#apply_loan').show();

		
		var l_pkID = $(this).attr("data-pk_id");
		var l_clientID = $(this).attr("data-client_id");
		var l_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var l_branch = $(this).attr("data-branch_id")+' - '+$(this).attr("data-branch_name");
		
		$('#l_pk_id').val(l_pkID);
		$('#l_client_id').val(l_clientID);
		$('#l_branch_id').val($(this).attr("data-branch_id"));

		$('#l_clientID').val(l_clientID);
		$('#l_clientName').val(l_clientName);
		$('#l_branch').val(l_branch);
		reloadSelectUi();
	});
	
	// approved client button
	$("#applyLoan_form").submit(function(e) {

        e.preventDefault();

		const form = document.getElementById("applyLoan_form");

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

					var data = $("#applyLoan_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/client-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									$('#tbl_client').show();
									$('#apply_loan').hide();

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
	$(document).on('click','#back_apply_form',function(e) {
		// get data in form
		
		$('#tbl_client').show();
		$('#apply_loan').hide();
		
	});


	// show hide div
	$(document).on('click','#back',function(e) {
		// get data in form
		$('#tbl_client').show();
		$('#view_client').hide();
		
	});

	// show hide div
	$(document).on('click','#addClient',function(e) {
		resetForm(addClient_form);
		
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

        if (!CustomValidationFeedback(form)) {
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

                    // var data = $("#addClient_form").serialize();
                    $.ajax({
                        url: "sql/client-sql-query.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
							cache: false,
						processData:false,
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

		reloadSelectUi();
	});


	// edit user submit
	$("#clientEdit_form").submit(function(e) {
		e.preventDefault();
        // validate form
        const form = document.getElementById("clientEdit_form");
	
        if (!CustomValidationFeedback(form)) {
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
					
					// var data = $("#clientEdit_form").serialize();
					$.ajax({
						url: "sql/client-sql-query.php",
						type: "POST",
						data:  new FormData(this),
						contentType: false,
							cache: false,
						processData:false,
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

	// delete client
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






	$(document).ready(function () {
		// Function to set the active tab value to localStorage
		function setActiveTabToLocalStorage(activeTabValue) {
			localStorage.setItem('activeTab', activeTabValue);
		}
	
		// Function to get the active tab value from localStorage
		function getActiveTabFromLocalStorage() {
			return localStorage.getItem('activeTab');
		}
	
		// Function to set the active tab on page load or use a default if none is stored
		function setActiveTabOnLoad() {
			
			$('.client-tab').removeClass('active'); // Remove active class from all tabs

			const storedActiveTab = getActiveTabFromLocalStorage();
			const defaultActiveTab = 'ACTV'; // Set your default active tab here
			
			if(performance.navigation.type=== 1){
				// refresh reset tab to pending
				initialActiveTab = defaultActiveTab;
				// remove active tab in local storage 
				localStorage.removeItem('activeTab');
			}
			else{
				// not refresh load to same tab 
				if(storedActiveTab){
					initialActiveTab = storedActiveTab;
				}
				else{
					initialActiveTab = defaultActiveTab;
				}
				
			}

			
			$(`.client-tab[data-value="${initialActiveTab}"]`).addClass('active');
			
			loadTable(initialActiveTab);
		}
	
		// Initialize the active tab
		setActiveTabOnLoad();
	
		// Handle tab click
		$('.client-tab').click(function () {
			$('.client-tab').removeClass('active'); // Remove active class from all tabs
			$(this).addClass('active'); // Add active class to clicked tab
			const activeTabValue = $(this).data('value');
			setActiveTabToLocalStorage(activeTabValue);
			loadTable(activeTabValue);
		});

	});

	function loadTable(activeTabValue) {
		Swal.fire({
			title: 'Loading',
			text: 'Please wait while data is being loaded...',
			allowOutsideClick: false,
			showCancelButton: false,
			showConfirmButton: false,
			onBeforeOpen: () => {
				Swal.showLoading();
			}
		});
        // start ajax 
        $.ajax({
          url: 'sql/client-sql-query.php',
          type: 'POST',
          dataType: 'json',
          data: {
            process: 'getData',
            status: activeTabValue
          },
          success: function(res) {
            swal.close();
            data = res.data;

            if(data.length <= 0){

              Swal.fire({
                icon: 'info',
                title: 'Oopss!...',
                text: res.message
              }).then(function() {
                $('#basic-1').DataTable().clear();
                $('#basic-1').DataTable().destroy();
                $('#basic-1').DataTable({
                  dom: 'Bfrtip',
                  lengthMenu: [
                  [ 10, 25, 50 ],
                  [ '10 rows', '25 rows', '50 rows' ]
                  ],
                  buttons: [
                  'pageLength'
                  ]});
              });
            }
            else{
              $('#basic-1').DataTable().clear();
              $('#basic-1').DataTable().destroy();
              $('#basic-1 tfoot th').each( function () {
                // var title = $(this).text();
                // $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
              } );


              $('#basic-1').DataTable({
                "data": data,
                "columns": [
                { "data": "ClientID"},
                { "data": null,
				  "render": function(data, type, row) {
					return data.LastName + ', ' + data.FirstName+ ' ' + data.MiddleName;
				  }
				},
				{ "data": null,
				  "render": function(data, type, row) {
					return data.BranchID + ' - ' + data.BranchName;
				  }
				},
                { "data": "StatusName"},
                {  "data": "CreatedAt",
					"render": function(data, type, row) {
					// Convert the date to "Y-m-d g:i a" format
					var date = new Date(data);
					var year = date.getFullYear();
					var month = String(date.getMonth() + 1).padStart(2, '0');
					var day = String(date.getDate()).padStart(2, '0');
					var hours = date.getHours();
					var minutes = String(date.getMinutes()).padStart(2, '0');
					var period = hours >= 12 ? 'PM' : 'AM';
					hours = hours % 12;
					hours = hours ? hours : 12; // Handle midnight (0 hours)
					var formattedDate = `${year}-${month}-${day} ${hours}:${minutes} ${period}`;
					return formattedDate;
					}
				},
                {
					"data": function(item) {
						// Check the StatusName and conditionally hide/show buttons
						var buttonsHtml = '';
				
						if (item.StatusName === "Active") {
						  buttonsHtml += '<a class="btn btn-pill btn-outline-info btn-xs" id="viewClient"  data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" data-last_name="' + item.LastName + '" data-first_name="' + item.FirstName + '" data-middle_name="' + item.MiddleName + '" data-branch_name="' + item.BranchName + '" data-branch_id="' + item.BranchID + '" data-birthday="' + item.Birthday + '" data-contact_no="' + item.ContactNo + '" data-address="' + item.Address + '" data-email="' + item.Email + '" data-business_name="' + item.BusinessName + '" data-business_address="' + item.BusinessAddress + '" data-gender="' + item.Gender + '" data-marital_name="' + item.MaritalName + '" data-age="' + item.Age + '" data-status_id="' + item.StatusID + '" data-status_name="' + item.StatusName + '"><i class="fa fa-eye" title="view"></i></a>  ';
						}
						else{
						  buttonsHtml += '<a class="btn btn-pill btn-outline-info btn-xs" id="viewClient"  data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" data-last_name="' + item.LastName + '" data-first_name="' + item.FirstName + '" data-middle_name="' + item.MiddleName + '" data-branch_name="' + item.BranchName + '" data-branch_id="' + item.BranchID + '" data-birthday="' + item.Birthday + '" data-contact_no="' + item.ContactNo + '" data-address="' + item.Address + '" data-email="' + item.Email + '" data-business_name="' + item.BusinessName + '" data-business_address="' + item.BusinessAddress + '" data-gender="' + item.Gender + '" data-marital_name="' + item.MaritalName + '" data-age="' + item.Age + '" data-status_id="' + item.StatusID + '" data-status_name="' + item.StatusName + '"><i class="fa fa-eye" title="view"></i></a>  ';
						  buttonsHtml += '<a class="btn btn-pill btn-outline-success btn-xs" id="editClient"  data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" data-last_name="' + item.LastName + '" data-first_name="' + item.FirstName + '" data-middle_name="' + item.MiddleName + '" data-branch_id="' + item.BranchID + '" data-birthday="' + item.Birthday + '" data-contact_no="' + item.ContactNo + '" data-address="' + item.Address + '" data-email="' + item.Email + '" data-business_name="' + item.BusinessName + '" data-business_address="' + item.BusinessAddress + '" data-gender="' + item.Gender + '" data-marital_status="' + item.MaritalStatus + '" data-age="' + item.Age + '" data-status_id="' + item.StatusID + '"><i class="fa fa-edit" title="Edit"></i></a>  ';
						  buttonsHtml += '<a class="btn btn-pill btn-outline-primary btn-xs" id="applyLoan"  data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" data-last_name="' + item.LastName + '" data-first_name="' + item.FirstName + '" data-middle_name="' + item.MiddleName + '" data-branch_id="' + item.BranchID + '" data-branch_name="' + item.BranchName + '"><i class="fa fa-file-text-o" title="Apply Loan"></i></a>  ';
						  buttonsHtml += '<a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteClient" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" ><i class="fa fa-trash-o" title="Delete"></i></a>';
						}
						buttonsHtml += '<a href="#" class="btn btn-pill btn-outline-secondary btn-xs" id="viewImage" data-bs-toggle="modal" data-bs-target="#exampleModalLong" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '" ><i class="fa fa-file-image-o" title="View Image"></i></a>';
				
				
						return buttonsHtml;
					  }
                }
                ],
                //      "columnDefs": [
                  //   {
                  //     "targets": 5,
                  //     "render": $.fn.dataTable.render.number(',', '$')
                  //   }
                  // ],
                  dom: 'Blfrtip',
                  lengthMenu: [
                  [ 10, 25, 50],
                  [ '10 rows', '25 rows', '50 rows']
                  ],
                  buttons: [ 'pageLength',
                //   { extend: 'copyHtml5', footer: true },
                //   { extend: 'excelHtml5', footer: true },
                //   { extend: 'csvHtml5', footer: true },
                //   { extend: 'print', footer: true },
                //   { extend: 'pdfHtml5', footer: true }


                  ],
                  "bDestroy": true,
                  "deferRender": true,
                  "bLengthChange": false,
                //   initComplete: function () {
                //   // Apply the search
                //   this.api().columns().every( function () {
                //     var that = this;

                //     $( 'input', this.footer() ).on( 'keyup change clear', function () {
                //       if ( that.search() !== this.value ) {
                //         that
                //         .search( this.value )
                //         .draw();
                //       }
                //     } );
                //   } );
                //   }
              });

            }

          }, error: function(err) {
            console.log(err);
          }
        
        }); // end ajax 

}  


});