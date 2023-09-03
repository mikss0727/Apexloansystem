function validateDecimalInput(input) {
    input.value = input.value.replace(/[^0-9.]/g, '');

    // Remove extra decimal points
    input.value = input.value.replace(/(\..*)\./g, '$1');
}
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}
document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.



	// show hide div
	$(document).on('click','#addRate',function(e) {
		
		$('#tbl_rate').hide();
		$('#add_rate').show();

		
	});

	// edit rate
	$(document).on('click','#editRate',function(e) {

		$('#tbl_rate').hide();
		$('#edit_rateForm').show();

		var edit_rateID=$(this).attr("data-rate_id");
		var edit_rateName=$(this).attr("data-rate_name");
		var edit_rate=$(this).attr("data-rate");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");


		$('#edit_rateID').val(edit_rateID);
		$('#edit_rateName').val(edit_rateName);
		$('#edit_rate').val(edit_rate);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
		reloadSelectUi();
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_rate').show();
		$('#add_rate').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_rate').show();
		$('#edit_rateForm').hide();
		
	});

	// add rate submit
	$("#addRate_form").submit(function(e) {

		
		var add_rateID = document.getElementById("add_rateID").value;
		var add_rateName = document.getElementById("add_rateName").value;
		var add_rate = document.getElementById("add_rate").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_rateID =='' || add_rateName =='' || add_rate =='' || add_isActive =='')
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

					var data = $("#addRate_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/rate-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_rate').hide();
								$('#tbl_rate').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'rate.php';
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



	// edit rate submit
	$("#rateEdit_form").submit(function(e) {


		var edit_rateID = document.getElementById("edit_rateID").value;
		var edit_rateName = document.getElementById("edit_rateName").value;
		var edit_rate = document.getElementById("edit_rate").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_rateName == '' || edit_isActive == '' || edit_rate == '' || edit_rateID == '')
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
					
					var data = $("#rateEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/rate-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'rate.php';
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

	// delete rate
	$(document).on('click','#deleteRate',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var rate_id=$(this).attr("data-rate_id");

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
						process:'deleteRate',
						pk_id: pk_id,
						rate_id: rate_id
					},
					type: "post",
					url: "sql/rate-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'rate.php';
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