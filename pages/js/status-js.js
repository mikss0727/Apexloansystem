
	// table data 
	function loadTable() {
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
          url: 'sql/status-sql-query.php',
          type: 'POST',
          dataType: 'json',
          data: {
            process: 'getData'
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

              // header footer title 
              // $('#basic-1 tfoot th').each( function () {
                // var title = $(this).text();
                // $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
              // } );


              $('#basic-1').DataTable({
                "data": data,
                "columns": [
                { "data": "StatusID"},
                { "data": "StatusName"},
                { "data": "CreatedBy"},
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
                { "data": "UpdatedBy"},
				{  "data": "UpdatedAt",
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
						if ((item.isActive == null) || (item.isActive == 0)){ 
							return	'<span class="label label-success">Active</span>'; 
						}
						else { 
							return '<span class="label label-info">Inactive</span>';
						}
					}
				  },


                    {
                      "data": function(item) {
                        return '<a class="btn btn-pill btn-outline-primary btn-xs" id="editStatus" data-toggle="modal" data-pk_id="' + item.id + '" data-status_id="' + item.StatusID + '" data-status_name="' + item.StatusName + '" data-isactive="' + item.isActive + '"> <i class="fa fa-edit" data-toggle="tooltip"  title="Edit"></i></a>  <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteStatus" data-pk_id="' + item.id + '" data-status_id="' + item.StatusID + '"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>';

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

document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

	loadTable();

	// show hide div
	$(document).on('click','#addStatus',function(e) {
		resetForm(addStatus_form);
		
		$('#tbl_status').hide();
		$('#add_status').show();

		
	});

	// edit status
	$(document).on('click','#editStatus',function(e) {

		$('#tbl_status').hide();
		$('#edit_status').show();

		var pk_id=$(this).attr("data-pk_id");
		var edit_statusID=$(this).attr("data-status_id");
		var edit_statusName=$(this).attr("data-status_name");
		var edit_isActive=$(this).attr("data-isactive");



		$('#pk_id').val(pk_id);
		$('#status_id').val(edit_statusID);
		$('#edit_statusName').val(edit_statusName);
		$('#edit_isActive').val(edit_isActive);
		reloadSelectUi();
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_status').show();
		$('#add_status').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_status').show();
		$('#edit_status').hide();
		
	});

	// add status submit
	$("#addStatus_form").submit(function(e) {
		e.preventDefault();

		const form = document.getElementById("addStatus_form");
	
        if (!ValidationFeedback(form)) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Some fields are empty or does not meet the condition!'
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

					var data = $("#addStatus_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/status-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
								$('#add_status').hide();
								$('#tbl_status').show();

									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										loadTable();
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



	// edit status submit
	$("#statusEdit_form").submit(function(e) {
		e.preventDefault();

		const form = document.getElementById("statusEdit_form");
	
        if (!ValidationFeedback(form)) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Some fields are empty or does not meet the condition!'
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
					
					var data = $("#statusEdit_form").serialize();
					
					$.ajax({
						data: data,
						type: "post",
						url: "sql/status-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){

									$('#tbl_status').show();
									$('#edit_status').hide();
								
									// alert('Data added successfully !'); 
									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										loadTable();
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
	$(document).on('click','#deleteStatus',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var status_id=$(this).attr("data-status_id");

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
						process:'deleteStatus',
						pk_id: pk_id,
						status_id: status_id
					},
					type: "post",
					url: "sql/status-sql-query.php",
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);

						if(dataResult.statusCode==0){


							// alert('Data added successfully !'); 
							Swal.fire({
								icon: 'success',
								title: 'Success...',
								text: dataResult.message
							}).then(function() {
								loadTable();
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