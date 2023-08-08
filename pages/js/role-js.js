
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// show hide div
	$(document).on('click','#addRole',function(e) {
		
		$('#tbl_role').hide();
		$('#add_role').show();

		
	});

	// edit user
	$(document).on('click','#editRole',function(e) {

		$('#tbl_role').hide();
		$('#edit_role').show();

		var edit_roleID=$(this).attr("data-role_id");
		var edit_roleName=$(this).attr("data-role_name");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_roleID').val(edit_roleID);
		$('#edit_roleName').val(edit_roleName);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_role').show();
		$('#add_role').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_role').show();
		$('#edit_role').hide();
		
	});

	// add user submit
	$("#addRole_form").submit(function(e) {

		
		var add_roleID = document.getElementById("add_roleID").value;
		var add_roleName = document.getElementById("add_roleName").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_roleID =='' || add_roleName =='' || add_isActive =='')
		{
			e.preventDefault();

			// alert("Please Fill All Required Field");
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Some fields does not meet the condition!'
			})

		}
		else{
			e.preventDefault();

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

					var data = $("#addRole_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/role-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_role').hide();
								$('#tbl_role').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'role.php';
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



	// edit user submit
	$("#roleEdit_form").submit(function(e) {


		var edit_roleID = document.getElementById("edit_roleID").value;
		var edit_roleName = document.getElementById("edit_roleName").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_roleName == '' || edit_isActive == '')
		{
			// alert("Please Fill All Required Field");
			e.preventDefault()

			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Some fields does not meet the condition!'
			})

		}
		else{
			e.preventDefault()

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
					
					var data = $("#roleEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/role-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'role.php';
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
	$(document).on('click','#deleteRole',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var role_id=$(this).attr("data-role_id");

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
						process:'deleteRole',
						pk_id: pk_id,
						role_id: role_id
					},
					type: "post",
					url: "sql/role-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'role.php';
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