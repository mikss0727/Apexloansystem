
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

// field validation
function ValidationFeedback(form) {

    const inputFields = form.querySelectorAll('.form-control');
    const validFeedbackList = form.querySelectorAll('.valid-feedback');
    const invalidFeedbackList = form.querySelectorAll('.invalid-feedback');

    let allFieldsValid = true;

    inputFields.forEach((inputField, index) => {
        if (inputField.validity.valid) {
            validFeedbackList[index].style.display = 'block';
            invalidFeedbackList[index].style.display = 'none';
        } else {
            validFeedbackList[index].style.display = 'none';
            invalidFeedbackList[index].style.display = 'block';
            allFieldsValid = false;
        }
    
    });
    return allFieldsValid;
}

	// show hide div
	$(document).on('click','#addUser',function(e) {
		
		$('#tbl_user').hide();
		$('#add_user').show();

		
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_user').show();
		$('#add_user').hide();
		
	});

    // add user submit
	$("#addUser_form").submit(function(e) {
        e.preventDefault();
        // validate form
        const form = document.getElementById("addUser_form");
	
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

                    var data = $("#addUser_form").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "sql/user-account-sql-query.php",
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
                                        window.location = 'user-account.php';
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

    
	// edit user account
	$(document).on('click','#editUserAccount',function(e) {

		$('#tbl_user').hide();
		$('#edit_user').show();

		var pk_id = $(this).attr("data-pk_id");
		var edit_EmpID = $(this).attr("data-user_id");
		var edit_Branch = $(this).attr("data-branch_id");
		var edit_Role = $(this).attr("data-role_id");
		var edit_isActive = $(this).attr("data-isactive");

		$('#pk_id').val(pk_id);
		$('#edit_EmpID').val(edit_EmpID);
		$('#p_edit_EmpID').val(edit_EmpID);
		$('#edit_Branch').val(edit_Branch);
		$('#edit_Role').val(edit_Role);
		$('#edit_isActive').val(edit_isActive);
		reloadSelectUi();
	});

    	// edit user submit
	$("#userEdit_form").submit(function(e) {
		e.preventDefault();
        // validate form
        const form = document.getElementById("userEdit_form");
	
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
					
					var data = $("#userEdit_form").serialize();
					
					$.ajax({
						data: data,
						type: "post",
						url: "sql/user-account-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'user-account.php';
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



	// delete user account
	$(document).on('click','#deleteUserAccount',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var user_id=$(this).attr("data-user_id");

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
						process:'deleteUserAccount',
						pk_id: pk_id,
						user_id: user_id
					},
					type: "post",
					url: "sql/user-account-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'user-account.php';
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

    
	// reset pass user account
	$(document).on('click','#resetPassword',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var user_id=$(this).attr("data-user_id");

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
						process:'resetPassword',
						pk_id: pk_id,
						user_id: user_id
					},
					type: "post",
					url: "sql/user-account-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'user-account.php';
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