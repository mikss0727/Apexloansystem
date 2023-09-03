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
	$(document).on('click','#addProduct',function(e) {
		
		$('#tbl_product').hide();
		$('#add_product').show();

		
	});

	// edit product
	$(document).on('click','#editProduct',function(e) {

		$('#tbl_product').hide();
		$('#edit_product').show();

		var edit_productID=$(this).attr("data-product_id");
		var edit_productName=$(this).attr("data-product_name");
		var edit_loanAmount=$(this).attr("data-loan_amount");
		var edit_isActive=$(this).attr("data-isactive");
		var pk_id=$(this).attr("data-pk_id");



		$('#edit_productID').val(edit_productID);
		$('#edit_productName').val(edit_productName);
		$('#edit_loanAmount').val(edit_loanAmount);
		$('#edit_isActive').val(edit_isActive);
		$('#pk_id').val(pk_id);
		reloadSelectUi()
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_product').show();
		$('#add_product').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_product').show();
		$('#edit_product').hide();
		
	});

	// add product submit
	$("#addProduct_form").submit(function(e) {

		
		var add_productID = document.getElementById("add_productID").value;
		var add_productName = document.getElementById("add_productName").value;
		var add_loanAmount = document.getElementById("add_loanAmount").value;
		var add_isActive = document.getElementById("add_isActive").value;

		if (add_productID =='' || add_productName =='' || add_isActive =='' || add_loanAmount =='')
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

					var data = $("#addProduct_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/product-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_product').hide();
								$('#tbl_product').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'product.php';
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



	// edit product submit
	$("#productEdit_form").submit(function(e) {


		var edit_productID = document.getElementById("edit_productID").value;
		var edit_productName = document.getElementById("edit_productName").value;
		var edit_loanAmount = document.getElementById("edit_loanAmount").value;
		var edit_isActive = document.getElementById("edit_isActive").value;

		if (edit_productName == '' || edit_isActive == '' || edit_productID == '' || edit_loanAmount == '')
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
					
					var data = $("#productEdit_form").serialize();
					console.log(data);
					$.ajax({
						data: data,
						type: "post",
						url: "sql/product-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'product.php';
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

	// delete Product
	$(document).on('click','#deleteProduct',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var product_id=$(this).attr("data-product_id");

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
						process:'deleteProduct',
						pk_id: pk_id,
						product_id: product_id
					},
					type: "post",
					url: "sql/product-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								window.location = 'product.php';
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