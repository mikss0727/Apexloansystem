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
          url: 'sql/employee-sql-query.php',
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
                { "data": null,
				  "render": function(data, type, row) {
					return data.LastName + ', ' + data.FirstName+ ' ' + data.MiddleName;
				  }
				},
                { "data": "DeptName"},
                { "data": "PositionName"},
                { "data": "ContactNo"},
                { "data": "Email"},
				{  "data": "Birthday",
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
					var formattedDate = `${year}-${month}-${day}`;
					return formattedDate;
					}
            	},
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
				{
					"data": function(item) {
					return '<a class="btn btn-pill btn-outline-info btn-xs" id="viewEmployee"data-pk_id="' + item.id + '"data-employee_id="' + item.EmployeeID + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-dept_name="' + item.DeptName + '"data-pos_name="' + item.PositionName + '"data-birthday="' + item.Birthday + '"data-contact_no="' + item.ContactNo + '"data-email="' + item.Email + '"data-isActive="' + item.isActive + '"><i class="fa fa-eye" title="view"></i></a>  <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editEmployee"data-pk_id="' + item.id + '"data-employee_id="' + item.EmployeeID + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-dept_id="' + item.DeptID + '"data-pos_id="' + item.PositionID + '"data-birthday="' + item.Birthday + '"data-contact_no="' + item.ContactNo + '"data-email="' + item.Email + '"data-isactive="' + item.isActive + '"><i class="fa fa-edit"title="Edit"></i></a> <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteEmployee"data-pk_id="' + item.id + '"data-employee_id="' + item.EmployeeID + '"><i class="fa fa-trash-o"title="Delete"></i></a>';

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

	// view Employee
	$(document).on('click','#viewEmployee',function(e) {
		
		$('#tbl_employee').hide();
		$('#view_employee').show();

		
		var v_employeeID = $(this).attr("data-employee_id");
		var v_employeeName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var v_dept = $(this).attr("data-dept_name");
		var v_pos = $(this).attr("data-pos_name");
		var v_bday = $(this).attr("data-birthday");
		var v_contactno = $(this).attr("data-contact_no");
		var v_email = $(this).attr("data-email");
		if($(this).attr("data-isActive") == 0){
			var v_status = 'Active'
		}
		else{
			var v_status = 'Inactive'
		};


		$('#v_employeeID').val(v_employeeID);
		$('#v_employeeName').val(v_employeeName);
		$('#v_dept').val(v_dept);
		$('#v_pos').val(v_pos);
		$('#v_bday').val(v_bday);
		$('#v_contactno').val(v_contactno);
		$('#v_email').val(v_email);
		$('#v_status').val(v_status);
		
	});



	// show hide div
	$(document).on('click','#back',function(e) {
		// get data in form
		$('#tbl_employee').show();
		$('#view_employee').hide();
		
	});

	// show hide div
	$(document).on('click','#addEmployee',function(e) {
		resetForm(addEmployee_form);
		
		$('#tbl_employee').hide();
		$('#add_employee').show();

		
	});

	// show hide div
	$(document).on('click','#cancel_add',function(e) {
		// get data in form
		$('#tbl_employee').show();
		$('#add_employee').hide();
		
	});

	// add employee submit
	$("#addEmployee_form").submit(function(e) {
        e.preventDefault();
        // validate form
        const form = document.getElementById("addEmployee_form");
	
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

                    var data = $("#addEmployee_form").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "sql/employee-sql-query.php",
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);

                            if(dataResult.statusCode==0){
                                
                                $('#add_employee').hide();
                                $('#tbl_employee').show();

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


	// edit employee
	$(document).on('click','#editEmployee',function(e) {

		$('#tbl_employee').hide();
		$('#edit_employee').show();

		var pk_id = $(this).attr("data-pk_id");
		var employee_id = $(this).attr("data-employee_id");
		var edit_lname = $(this).attr("data-last_name");
		var edit_fname = $(this).attr("data-first_name");
		var edit_mname = $(this).attr("data-middle_name");
		var edit_bday = $(this).attr("data-birthday");
		var edit_contactno = $(this).attr("data-contact_no");
		var edit_email = $(this).attr("data-email");
		var edit_deptID = $(this).attr("data-dept_id");
		var edit_posID = $(this).attr("data-pos_id");
		var edit_isActive = $(this).attr("data-isactive");


        // Convert to Date object
        var parsedDate = new Date(edit_bday);

        // Format the date as "yyyy-MM-dd"
        var formattedDate = parsedDate.toISOString().split('T')[0];



		$('#pk_id').val(pk_id);
		$('#employee_id').val(employee_id);
		$('#edit_lname').val(edit_lname);
		$('#edit_fname').val(edit_fname);
		$('#edit_mname').val(edit_mname);
		$('#edit_bday').val(formattedDate);
		$('#edit_contactno').val(edit_contactno);
		$('#edit_email').val(edit_email);
		$('#edit_deptID').val(edit_deptID);
		$('#edit_posID').val(edit_posID);
		$('#edit_isActive').val(edit_isActive);

		reloadSelectUi();
	});

    // show hide div
	$(document).on('click','#cancel_edit',function(e) {
		// get data in form
        $('#tbl_employee').show();
		$('#edit_employee').hide();
		
	});


	// edit employee submit
	$("#employeeEdit_form").submit(function(e) {
		e.preventDefault();
        // validate form
        const form = document.getElementById("employeeEdit_form");
	
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
					
					var data = $("#employeeEdit_form").serialize();
					
					$.ajax({
						data: data,
						type: "post",
						url: "sql/employee-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){

									$('#tbl_employee').show();
									$('#edit_employee').hide();
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

	// delete Employee
	$(document).on('click','#deleteEmployee',function(e) {
		var pk_id=$(this).attr("data-pk_id");
		var employee_id=$(this).attr("data-employee_id");

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
						process:'deleteEmployee',
						pk_id: pk_id,
						employee_id: employee_id
					},
					type: "post",
					url: "sql/employee-sql-query.php",
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