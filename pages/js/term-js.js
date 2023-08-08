function validateDecimalInput(input) {
    input.value = input.value.replace(/\D/g, '');
}
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// show hide div
	$(document).on('click','#addTerm',function(e) {
		
		$('#tbl_term').hide();
		$('#add_term').show();

		
	});

	// edit user
	$(document).on('click','#editTerm',function(e) {

		$('#tbl_term').hide();
		$('#edit_term').show();

		var edit_termID=$(this).attr("data-term_id");
		var edit_termName=$(this).attr("data-term_name");
		var edit_weeksNo=$(this).attr("data-weeks_no");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_termID').val(edit_termID);
		$('#edit_termName').val(edit_termName);
		$('#edit_weeksNo').val(edit_weeksNo);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_term').show();
		$('#add_term').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_term').show();
		$('#edit_term').hide();
		
	});

	// add user submit
	$("#addTerm_form").submit(function(e) {

		
		var add_termID = document.getElementById("add_termID").value;
		var add_termName = document.getElementById("add_termName").value;
		var add_weeksNo = document.getElementById("add_weeksNo").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_termID =='' || add_termName =='' || add_isActive =='' || add_weeksNo =='')
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

					var data = $("#addTerm_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/term-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_term').hide();
								$('#tbl_term').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'term.php';
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
	$("#termEdit_form").submit(function(e) {


		var edit_termID = document.getElementById("edit_termID").value;
		var edit_termName = document.getElementById("edit_termName").value;
		var edit_weeksNo = document.getElementById("edit_weeksNo").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_termName == '' || edit_isActive == '' || edit_termID == '' || edit_weeksNo == '')
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
					
					var data = $("#termEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/term-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'term.php';
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

	// delete Term
	$(document).on('click','#deleteTerm',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var term_id=$(this).attr("data-term_id");

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
						process:'deleteTerm',
						pk_id: pk_id,
						term_id: term_id
					},
					type: "post",
					url: "sql/term-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'term.php';
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