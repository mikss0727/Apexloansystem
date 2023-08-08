
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// show hide div
	$(document).on('click','#addBranch',function(e) {
		
		$('#tbl_branch').hide();
		$('#add_branch').show();

		
	});

	// edit user
	$(document).on('click','#editBranch',function(e) {

		$('#tbl_branch').hide();
		$('#edit_branch').show();

		var edit_branchID=$(this).attr("data-branch_id");
		var edit_branchName=$(this).attr("data-pos_name");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_branchID').val(edit_branchID);
		$('#edit_branchName').val(edit_branchName);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_branch').show();
		$('#add_branch').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_branch').show();
		$('#edit_branch').hide();
		
	});

	// add user submit
	$("#addBranch_form").submit(function(e) {

		
		var add_branchID = document.getElementById("add_branchID").value;
		var add_branchName = document.getElementById("add_branchName").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_branchID =='' || add_branchName =='' || add_isActive =='')
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

					var data = $("#addBranch_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/branch-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_branch').hide();
								$('#tbl_branch').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'branch.php';
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
	$("#branchEdit_form").submit(function(e) {


		var edit_branchID = document.getElementById("edit_branchID").value;
		var edit_branchName = document.getElementById("edit_branchName").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_branchName == '' || edit_isActive == '' || edit_branchID == '')
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
					
					var data = $("#branchEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/branch-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'branch.php';
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
	$(document).on('click','#deleteBranch',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var branch_id=$(this).attr("data-branch_id");

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
						process:'deleteBranch',
						pk_id: pk_id,
						branch_id: branch_id
					},
					type: "post",
					url: "sql/branch-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'branch.php';
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