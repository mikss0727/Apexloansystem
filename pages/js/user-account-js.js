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
          url: 'sql/user-account-sql-query.php',
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
                { "data": "EmployeeID"},
                { "data": "EmployeeName"},
				{ "data": null,
				  "render": function(data, type, row) {
					return data.BranchID + ' - ' + data.BranchName;
				  }
				},
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
                        return '<a class="btn btn-pill btn-outline-primary btn-xs" id="editUserAccount" data-toggle="modal" data-pk_id="' + item.id + '" data-user_id="' + item.EmployeeID + '" data-branch_id="' + item.BranchID + '" data-role_id="' + item.RoleID + '" data-isactive="' + item.isActive + '"> <i class="fa fa-edit" data-toggle="tooltip"  title="Edit"></i></a>  <a href="#" class="btn btn-pill btn-outline-warning btn-xs" id="resetPassword" data-pk_id="' + item.id + '" data-user_id="' + item.EmployeeID + '"> <i class="fa fa-rotate-right" data-toggle="tooltip"  title="Reset Password"></i></a>  <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteUserAccount" data-pk_id="' + item.id + '" data-user_id="' + item.EmployeeID + '"> <i class="fa fa-trash-o" data-toggle="tooltip"  title="Delete"></i></a>';

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
	$(document).on('click','#addUser',function(e) {
		resetForm(addUser_form);
		
		$('#tbl_user').hide();
		$('#add_user').show();

		
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_user').show();
		$('#add_user').hide();
		
	});

	// show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
		$('#tbl_user').show();
		$('#edit_user').hide();
		
	});

    // add user submit
	$("#addUser_form").submit(function(e) {
		e.preventDefault();

		const form = document.getElementById("addUser_form");
	
        if (!ValidationFeedback(form)) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Some fields are empty or does not meet the condition!'
				})
        }else {
            
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
                                
								$('#tbl_user').show();
								$('#add_user').hide();

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

									$('#tbl_user').show();
									$('#edit_user').hide();
								
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