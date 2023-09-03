function validateDecimalInput(input) {
    input.value = input.value.replace(/\D/g, '');
}
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	// show hide div
	$(document).on('click','#addTermType',function(e) {
		
		$('#tbl_termType').hide();
		$('#add_termType').show();

		
	});

	// edit term type
	$(document).on('click','#editTermType',function(e) {

		$('#tbl_termType').hide();
		$('#edit_termType').show();

		var edit_typeID=$(this).attr("data-type_id");
		var edit_typeName=$(this).attr("data-type_name");
		var edit_daysNo=$(this).attr("data-days_no");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_typeID').val(edit_typeID);
		$('#edit_typeName').val(edit_typeName);
		$('#edit_daysNo').val(edit_daysNo);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
		reloadSelectUi();
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_termType').show();
		$('#add_termType').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_termType').show();
		$('#edit_termType').hide();
		
	});

	// add term type submit
	$("#addTermType_form").submit(function(e) {

		
		var add_typeID = document.getElementById("add_typeID").value;
		var add_typeName = document.getElementById("add_typeName").value;
		var add_daysNo = document.getElementById("add_daysNo").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_typeID =='' || add_typeName =='' || add_isActive =='' || add_daysNo =='')
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

					var data = $("#addTermType_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/term-type-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_termType').hide();
								$('#tbl_termType').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'term-type.php';
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



	// edit term type submit
	$("#termTypeEdit_form").submit(function(e) {


		var edit_typeID = document.getElementById("edit_typeID").value;
		var edit_typeName = document.getElementById("edit_typeName").value;
		var edit_daysNo = document.getElementById("edit_daysNo").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_typeName == '' || edit_isActive == '' || edit_typeID == '' || edit_daysNo == '')
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
					
					var data = $("#termTypeEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/term-type-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'term-type.php';
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
	$(document).on('click','#deleteTermType',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var type_id=$(this).attr("data-type_id");

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
						process:'deleteTermType',
						pk_id: pk_id,
						type_id: type_id
					},
					type: "post",
					url: "sql/term-type-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'term-type.php';
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