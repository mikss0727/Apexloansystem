
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}

document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// show hide div
	$(document).on('click','#addDepartment',function(e) {
		
		$('#tbl_department').hide();
		$('#add_department').show();

		
	});

	// edit department
	$(document).on('click','#editDepartment',function(e) {

		$('#tbl_department').hide();
		$('#edit_department').show();

		var edit_deptID=$(this).attr("data-dept_id");
		var edit_deptName=$(this).attr("data-dept_name");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_deptID').val(edit_deptID);
		$('#edit_deptName').val(edit_deptName);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
		reloadSelectUi();
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_department').show();
		$('#add_department').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_department').show();
		$('#edit_department').hide();
		
	});

	// add user submit
	$("#addDept_form").submit(function(e) {
		
		var add_deptID = document.getElementById("add_deptID").value;
		var add_deptName = document.getElementById("add_deptName").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_deptID =='' || add_deptName =='' || add_isActive =='')
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

					var data = $("#addDept_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/department-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_department').hide();
								$('#tbl_department').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'department.php';
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
	$("#departmentEdit_form").submit(function(e) {


		var edit_deptID = document.getElementById("edit_deptID").value;
		var edit_deptName = document.getElementById("edit_deptName").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_deptName == '' || edit_isActive == '')
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
					
					var data = $("#departmentEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/department-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'department.php';
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

	// delete Department
	$(document).on('click','#deleteDepartment',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var dept_id=$(this).attr("data-dept_id");

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
						process:'deleteDepartment',
						pk_id: pk_id,
						dept_id: dept_id
					},
					type: "post",
					url: "sql/department-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'department.php';
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