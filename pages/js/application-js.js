
// table data 
function loadTable(status) {
	
	var baseUrl = window.location.protocol + "//" + window.location.host;
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
		url: 'sql/application-sql-query.php',
		type: 'POST',
		dataType: 'json',
		data: {
		process: 'getData',
        status: status
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
            { "data": "ClientID"},
            { "data": "ApplicationNo"},
            { "data": null,
              "render": function(data, type, row) {
                return data.LastName + ', ' + data.FirstName+ ' ' + data.MiddleName;
              }
            },
            { "data": null,
              "render": function(data, type, row) {
                return data.BranchID + ' - ' + data.BranchName;
              }
            },
			{ "data": "LoanAmount"},
			{ "data": "DisbursementDate"},
			{ "data": "LoanType"},
			{ "data": "ClosedDate"},


				{
					"data": function(item) {
						
					var buttonsHtml = '';
					if (item.StatusID === "PND") {
					// edit button 
					buttonsHtml += '<a class="btn btn-pill btn-outline-success btn-xs" id="editApplication" data-toggle="modal" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '"data-application_no="' + item.ApplicationNo + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-branch_id="' + item.BranchID + '"data-branch_name="' + item.BranchName + '"data-product_id="' + item.ProductID + '"data-interest_code="' + item.InterestCode + '"data-term_type="' + item.TermType + '"data-disb_date="' + item.DisbursementDate + '"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>  ';
					
					// process button 
					buttonsHtml += '<a class="btn btn-pill btn-outline-info btn-xs" id="processApplication" data-toggle="modal" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '"data-application_no="' + item.ApplicationNo + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-branch_id="' + item.BranchID + '"data-branch_name="' + item.BranchName + '"data-product_id="' + item.ProductID + '"data-product_name="' + item.ProductName + '"data-loan_amount="' + item.LoanAmount + '"data-interest_code="' + item.InterestCode + '"data-term_type="' + item.TermType + '"data-term_name="' + item.TypeName + '"data-term_no="' + item.TermNo + '"data-disb_date="' + item.DisbursementDate + '"><i class="fa fa-eye" data-toggle="tooltip" title="View"></i></a>  ';
					}
					if (item.StatusID === "FORDISB") {
					// disbursed button 
					buttonsHtml += '<a class="btn btn-pill btn-outline-primary btn-xs" id="disburseApplication" data-toggle="modal" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '"data-application_no="' + item.ApplicationNo + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-branch_id="' + item.BranchID + '"data-branch_name="' + item.BranchName + '"data-product_id="' + item.ProductID + '"data-product_name="' + item.ProductName + '"data-loan_amount="' + item.LoanAmount + '"data-interest_code="' + item.InterestCode + '"data-term_type="' + item.TermType + '"data-term_name="' + item.TypeName + '"data-term_no="' + item.TermNo + '"data-disb_date="' + item.DisbursementDate + '"data-rate="' + item.Rate + '"data-days_no="' + item.DaysNo + '"><i class="fa fa-paper-plane-o" data-toggle="tooltip" title="Disburse"></i></a>  ';
					}
					if (item.StatusID === "DISB") {
					// download pdf button 
					buttonsHtml += '<a class="btn btn-pill btn-outline-warning btn-xs" data-toggle="modal" href="'+baseUrl+'/LoanSchedule/' + item.ApplicationNo + '/' + item.ApplicationNo + '.pdf" download="' + item.ApplicationNo + '.pdf"><i class="fa fa-download" data-toggle="tooltip" title="Download Schedule"></i></a>  ';
					buttonsHtml += '<a class="btn btn-pill btn-outline-secondary btn-xs" id="paymentSchedule" data-toggle="modal" data-pk_id="' + item.id + '" data-client_id="' + item.ClientID + '"data-application_no="' + item.ApplicationNo + '"data-last_name="' + item.LastName + '"data-first_name="' + item.FirstName + '"data-middle_name="' + item.MiddleName + '"data-branch_id="' + item.BranchID + '"data-branch_name="' + item.BranchName + '"data-product_id="' + item.ProductID + '"data-product_name="' + item.ProductName + '"data-loan_amount="' + item.LoanAmount + '"data-interest_code="' + item.InterestCode + '"data-term_type="' + item.TermType + '"data-term_name="' + item.TypeName + '"data-term_no="' + item.TermNo + '"data-disb_date="' + item.DisbursementDate + '"data-rate="' + item.Rate + '"data-days_no="' + item.DaysNo + '"><i class="fa fa-file-text" data-toggle="tooltip" title="Schedule"></i></a>  ';
					}


					return buttonsHtml;
					}
				},
				],
                "columnDefs": [
                        {
                            "targets": 4,
                            "render": function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Format LoanAmount with commas as thousands separators, a dollar sign, and two decimal places
                                return parseFloat(data).toLocaleString(undefined, {
                                style: 'currency',
                                currency: 'PHP',
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                                });
                            }
                            return data;
                            }
                        //   "render": $.fn.dataTable.render.number(',', '$')
                        }
                    ],
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


function loadAmortizationTable(a_applicationNo,a_branch,a_loan_product) {
	// start ajax 
	$.ajax({
		url: 'sql/application-sql-query.php',
		type: 'POST',
		dataType: 'json',
		data: {
		process: 'getSchedule',
		application_no: a_applicationNo,
		branch: a_branch,
		product_id: a_loan_product
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
			$('#basic-2').DataTable().clear();
			$('#basic-2').DataTable().destroy();
			$('#basic-2').DataTable({
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
			$('#basic-2').DataTable().clear();
			$('#basic-2').DataTable().destroy();

			// header footer title 
			// $('#basic-2 tfoot th').each( function () {
			// var title = $(this).text();
			// $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			// } );
			// get user role 
			var SESSION_RoleID =  getRoleID();

			$('#basic-2').DataTable({
			"data": data,
			"columns": [
			{ "data": "ApplicationNo"},
			{ "data": "BranchID"},
			{ "data": "ProductCode"},
			{ "data": "InstallmentNo"},
			{ "data": "InstallmentAmount"},
			{ "data": "Balance"},
			// { "data": "DueDate"},
			 // DueDate column rendering
			 {
				"data": "DueDate",
				"render": function (data, type, row) {
					if (type === "display" || type === "filter") {
						if (data === null || data.trim() === "") {
							return ""; // Display "null" for empty data
						}
						var dateTime = new Date(data); // Parse the date/time string
						return dateTime.toLocaleString('en-US', {
							year: 'numeric',
							month: 'short',
							day: 'numeric',
							hour: '2-digit',
							minute: '2-digit',
							hour12: true
						});
					}
					return data;
				}
			},
			{
				"data": function(item) {
					if (item.StatusID == 'PND'){ 
						return	'<span class="label label-info">Pending</span>'; 
					}
					else if (item.StatusID == 'OP'){ 
						return	'<span class="label label-secondary">On Process</span>'; 
					}
					else if (item.StatusID == 'DUE'){ 
						return	'<span class="label label-danger">Due</span>'; 
					}
					else if (item.StatusID == 'PAID'){ 
						return	'<span class="label label-success">Paid</span>'; 
					}
					else { 
						return '<span class="label label-warning">---</span>';
					}
				}
			  },
			  { "data": "PostRemarks"},
			  { "data": "PostedBy"},
			//   { "data": "PostedAt"},
			//   { "data": "ConfirmAt"},
			   // PostedAt column rendering
			   {
					"data": "PostedAt",
					"render": function (data, type, row) {
						if (type === "display" || type === "filter") {
							if (data === null || data.trim() === "") {
								return ""; // Display "null" for empty data
							}
							var dateTime = new Date(data); // Parse the date/time string
							return dateTime.toLocaleString('en-US', {
								year: 'numeric',
								month: 'short',
								day: 'numeric',
								hour: '2-digit',
								minute: '2-digit',
								hour12: true
							});
						}
						return data;
					}
				},
				
				{ "data": "ConfirmRemarks"},
				{ "data": "ConfirmBy"},
		
				// ConfirmAt column rendering
				{
					"data": "ConfirmAt",
					"render": function (data, type, row) {
						if (type === "display" || type === "filter") {
							if (data === null || data.trim() === "") {
								return ""; // Display "null" for empty data
							}
							var dateTime = new Date(data); // Parse the date/time string
							return dateTime.toLocaleString('en-US', {
								year: 'numeric',
								month: 'short',
								day: 'numeric',
								hour: '2-digit',
								minute: '2-digit',
								hour12: true
							});
						}
						return data;
					}
				},

				{
					"data": function(item) {
						

					var buttonsHtml = '';
					if (SESSION_RoleID === "super") {
						if (item.StatusID === "OP") {
						// confirm payment button 
						buttonsHtml += '<a class="btn btn-pill btn-outline-primary btn-xs" id="confirmPayment" data-bs-toggle="modal" data-bs-target="#confirmPaymentModal" data-pk_id="' + item.id + '"data-application_no="' + item.ApplicationNo + '"data-branch_id="' + item.BranchID + '"data-product_id="' + item.ProductCode + '"data-installment_no="' + item.InstallmentNo + '"><i class="fa fa-check-square-o" data-toggle="tooltip" title="Confirm Payment"></i></a>  ';
						}
					}

					if (item.StatusID === "PND") {
					// payment button 
					buttonsHtml += '<a class="btn btn-pill btn-outline-warning btn-xs" id="postPayment" data-bs-toggle="modal" data-bs-target="#postPaymentModal" data-pk_id="' + item.id + '"data-application_no="' + item.ApplicationNo + '"data-branch_id="' + item.BranchID + '"data-product_id="' + item.ProductCode + '"data-installment_no="' + item.InstallmentNo + '"><i class="fa fa-share-square-o" data-toggle="tooltip" title="Post Payment"></i></a>  ';
					
					}


					return buttonsHtml;
					}
				},
				],
				"columnDefs": [
						{
							"targets": 4,
							"render": function(data, type, row) {
							if (type === 'display' || type === 'filter') {
								// Format LoanAmount with commas as thousands separators, a dollar sign, and two decimal places
								return parseFloat(data).toLocaleString(undefined, {
								style: 'currency',
								currency: 'PHP',
								minimumFractionDigits: 2,
								maximumFractionDigits: 2
								});
							}
							return data;
							}
						//   "render": $.fn.dataTable.render.number(',', '$')
						},
						{
							"targets": 5,
							"render": function(data, type, row) {
							if (type === 'display' || type === 'filter') {
								// Format LoanAmount with commas as thousands separators, a dollar sign, and two decimal places
								return parseFloat(data).toLocaleString(undefined, {
								style: 'currency',
								currency: 'PHP',
								minimumFractionDigits: 2,
								maximumFractionDigits: 2
								});
							}
							return data;
							}
						//   "render": $.fn.dataTable.render.number(',', '$')
						}
					],
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

    $(document).ready(function () {
		// Function to set the active tab value to localStorage
		function setActiveTabToLocalStorage(activeTabValue) {
			localStorage.setItem('status', activeTabValue);
		}
	
		// Function to get the active tab value from localStorage
		function getActiveTabFromLocalStorage() {
			return localStorage.getItem('status');
		}
	
		// Function to set the active tab on page load or use a default if none is stored
		function setActiveTabOnLoad() {
			
			$('.application-tab').removeClass('active'); // Remove active class from all tabs

			const storedActiveTab = getActiveTabFromLocalStorage();
			const defaultActiveTab = 'PND'; // Set your default active tab here
			
			if(performance.navigation.type=== 1){
				// refresh reset tab to pending
				initialActiveTab = defaultActiveTab;
				// remove active tab in local storage 
				localStorage.removeItem('activeTab');
			}
			else{
				// not refresh load to same tab 
				if(storedActiveTab){
					initialActiveTab = storedActiveTab;
				}
				else{
					initialActiveTab = defaultActiveTab;
				}
				
			}

			$(`.application-tab[data-value="${initialActiveTab}"]`).addClass('active');
			
			loadTable(initialActiveTab);
		}
	
		// Initialize the active tab
		setActiveTabOnLoad();
	
		// Handle tab click
		$('.application-tab').click(function () {
			$('.application-tab').removeClass('active'); // Remove active class from all tabs
			$(this).addClass('active'); // Add active class to clicked tab
			const activeTabValue = $(this).data('value');
			setActiveTabToLocalStorage(activeTabValue);
			loadTable(activeTabValue);
		});

	});


	
	// edit Application
	$(document).on('click','#editApplication',function(e) {

		
		$('#tbl_application').hide();
		$('#edit_application').show();

		var pk_id = $(this).attr("data-pk_id");
		var a_clientID = $(this).attr("data-client_id");
		var a_applicationNo = $(this).attr("data-application_no");
		var a_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var a_branch =  $(this).attr("data-branch_id")+' - '+$(this).attr("data-branch_name");
		var a_loan_product = $(this).attr("data-product_id");
		var a_loan_rate = $(this).attr("data-interest_code");
		var a_loan_term_type = $(this).attr("data-term_type");

		// convert date for edit format
		var parts = $(this).attr("data-disb_date").split(" ");
		var a_loan_disbDate = parts[0];

		$('#pk_id').val(pk_id);
		$('#a_application_no').val(a_applicationNo);
		$('#a_clientID').val(a_clientID);
		$('#a_applicationNo').val(a_applicationNo);
		$('#a_clientName').val(a_clientName);
		$('#a_branch').val(a_branch);
		$('#a_loan_product').val(a_loan_product);
		$('#a_loan_rate').val(a_loan_rate);
		$('#a_loan_term_type').val(a_loan_term_type);
		$('#a_loan_disbDate').val(a_loan_disbDate);
		reloadSelectUi();
	});

	$(document).on('click','#back',function(e) {
		
		$('#tbl_application').show();
		$('#edit_application').hide();
	});

	
	// submit edit application button
	$("#application_form").submit(function(e) {

        e.preventDefault();

		const form = document.getElementById("application_form");
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

					var data = $("#application_form").serialize();
					$.ajax({
						data: data,
						type: "post",
						url: "sql/application-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									$('#tbl_application').show();
									$('#edit_application').hide();

									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										window.location = 'application.php';
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


	
	
	// view and process Application
	$(document).on('click','#processApplication',function(e) {
		

		$('#tbl_application').hide();
		$('#view_application').show();

		var v_pk_id = $(this).attr("data-pk_id");
		var v_clientID = $(this).attr("data-client_id");
		var v_applicationNo = $(this).attr("data-application_no");
		var v_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var v_branch =  $(this).attr("data-branch_id")+' - '+$(this).attr("data-branch_name");
		var v_loan_product = $(this).attr("data-product_name")+' - '+parseFloat($(this).attr("data-loan_amount")).toLocaleString('en-US', {
			style: 'decimal',
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		  });
		  ;
		var v_loan_term = $(this).attr("data-term_name")+' - '+$(this).attr("data-term_no")+' Collection';

		// convert date for edit format
		var parts = $(this).attr("data-disb_date").split(" ");
		var v_loan_disbDate = parts[0];

		$('#v_pk_id').val(v_pk_id);
		$('#v_clientID').val(v_clientID);
		$('#v_application_no').val(v_applicationNo);

		$('#v_applicationNo').val(v_applicationNo);
		$('#v_clientName').val(v_clientName);
		$('#v_branch').val(v_branch);
		$('#v_loan_product').val(v_loan_product);
		$('#v_loan_term').val(v_loan_term);
		$('#v_loan_disbDate').val(v_loan_disbDate);

		
		var id_front = '../../kyc_images/'+v_clientID+'/ID_FRONT';
		var id_back = '../../kyc_images/'+v_clientID+'/ID_BACK';
	
		const f_id = document.getElementById('f_id');
		const b_id = document.getElementById('b_id');
		// Find elements inside the div
		var f_figure = f_id.querySelector("figure");
		var f_a = f_figure.querySelector("a");
		var f_img = f_a.querySelector("img");
		f_a.setAttribute("href", id_front+'.jpg');
		f_img.src = id_front+'.jpg';
	
		var b_figure = b_id.querySelector("figure");
		var b_a = b_figure.querySelector("a");
		var b_img = b_a.querySelector("img");
		b_a.setAttribute("href", id_back+'.jpg');
		b_img.src = id_back+'.jpg';
	
	});

	$(document).on('click','#cancel_process',function(e) {
		
		$('#tbl_application').show();
		$('#view_application').hide();
	});

	
	// process submit
	$("#process_application_form").submit(function(e) {
        e.preventDefault();
        // validate form
        const form = document.getElementById("process_application_form");

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

                    var data = $("#process_application_form").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "sql/application-sql-query.php",
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);

                            if(dataResult.statusCode==0){
                                
								$('#tbl_application').show();
								$('#view_application').hide();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success...',
                                        text: dataResult.message
                                    }).then(function() {
                                        window.location = 'application.php';
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


	
	// disburse Application
	$(document).on('click','#disburseApplication',function(e) {
		

		var d_pk_id = $(this).attr("data-pk_id");
		var d_rate = $(this).attr("data-rate");
		var d_clientID = $(this).attr("data-client_id");
		var d_applicationNo = $(this).attr("data-application_no");
		var d_productID = $(this).attr("data-product_id");
		var d_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var d_branch_id =  $(this).attr("data-branch_id");
		var d_branch_name =  $(this).attr("data-branch_name");
		var d_loan_amount =  $(this).attr("data-loan_amount");
		var d_loan_term =  $(this).attr("data-term_no");
		var d_days_no =  $(this).attr("data-days_no");
		// convert date format
		var parts = $(this).attr("data-disb_date").split(" ");
		var d_loan_disbDate = parts[0];

		

		const client_data ={
			pk_id: d_pk_id,
			clientID: d_clientID,
			applicationNo: d_applicationNo,
			clientName: d_clientName,
			branch_id: d_branch_id,
			branch_name: d_branch_name,
			loan_amount: d_loan_amount,
			disbDate: d_loan_disbDate,
			product_id:d_productID
		  };
		var loan_principal = compute(d_loan_amount,d_rate);
		const paymentSchedule = generateLoanSchedule(d_loan_term,loan_principal,d_loan_disbDate,d_days_no);

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Continue!'
		}).then((result) => {

			if(result.isConfirmed){
				Swal.fire({
					title: 'Loading',
					text: 'Please wait while data is being process...',
					allowOutsideClick: false,
					showCancelButton: false,
					showConfirmButton: false,
					onBeforeOpen: () => {
						Swal.showLoading();
					}
				});
	
				$.ajax({
					data:{
						process:'DisburseClient',
						client_data: JSON.stringify(client_data) ,
						paymentSchedule: JSON.stringify(paymentSchedule) 
					},
					type: "post",
					url: "sql/application-sql-query.php",
					success: function(dataResult){
	
						swal.close();
						var dataResult = JSON.parse(dataResult);
	
						if(dataResult.statusCode==0){
							
	
								Swal.fire({
									icon: 'success',
									title: 'Success...',
									text: dataResult.message
								}).then(function() {
									window.location = 'application.php';
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
					}); //end ajax
			}
			
		}) // end swal

	});



	
	// payment schedule
	$(document).on('click','#paymentSchedule',function(e) {
		
		$('#tbl_application').hide();
		$('#view_amortization').show();

		var a_applicationNo = $(this).attr("data-application_no");
		var a_clientName = $(this).attr("data-last_name")+', '+$(this).attr("data-first_name")+' '+$(this).attr("data-middle_name");
		var a_branch =  $(this).attr("data-branch_id");
		var a_loan_product = $(this).attr("data-product_id");

			$('#c_name').text(a_clientName);
			$('#c_appno').text(a_applicationNo);

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
		loadAmortizationTable(a_applicationNo,a_branch,a_loan_product);

				// Post Payment Button 
		$(document).on('click','#postPayment',function(e) {
			



			var p_applicationNo = $(this).attr("data-application_no");
			var p_branchID = $(this).attr("data-branch_id");
			var p_productCode = $(this).attr("data-product_id");
			var p_installmentNo = $(this).attr("data-installment_no");
			
			$('#postApplicationNo').val(p_applicationNo);
			$('#postBranchID').val(p_branchID);
			$('#postProductCode').val(p_productCode);
			$('#postInstallmentNo').val(p_installmentNo);				
			
		});

		// Post Payment Button 
		$(document).on('click','#confirmPayment',function(e) {
	



			var c_applicationNo = $(this).attr("data-application_no");
			var c_branchID = $(this).attr("data-branch_id");
			var c_productCode = $(this).attr("data-product_id");
			var c_installmentNo = $(this).attr("data-installment_no");
			
			$('#confirmApplicationNo').val(c_applicationNo);
			$('#confirmBranchID').val(c_branchID);
			$('#confirmProductCode').val(c_productCode);
			$('#confirmInstallmentNo').val(c_installmentNo);				
			
		});

		
	});

	$(document).on('click','#back_view_amort',function(e) {
		
		$('#tbl_application').show();
		$('#view_amortization').hide();
	});


	// post payment button
	$("#postPaymentForm").submit(function(e) {

        e.preventDefault();

		const form = document.getElementById("postPaymentForm");
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

					var data = $("#postPaymentForm").serialize();

						// Split the query string into an array of key-value pairs
						var keyValuePairs = data.split('&');

						// Create an empty object to store the key-value pairs
						var data = {};

						// Iterate through the key-value pairs and assign them to the object
						for (var i = 0; i < keyValuePairs.length; i++) {
							var pair = keyValuePairs[i].split('=');
							var key = decodeURIComponent(pair[0]);  // Decode the key (in case it contains special characters)
							var value = decodeURIComponent(pair[1]); // Decode the value
							data[key] = value;
						}

						// Now you have an object where each key is a variable name, and each value is the corresponding value
						var postRemarks = data.postRemarks;
						var postApplicationNo = data.postApplicationNo;
						var postBranchID = data.postBranchID;
						var postProductCode = data.postProductCode;
						var postInstallmentNo = data.postInstallmentNo;
						
					$.ajax({
						data: data,
						type: "post",
						url: "sql/application-sql-query.php",
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);

							if(dataResult.statusCode==0){
								
									$('#postPaymentModal').modal('hide');

									Swal.fire({
										icon: 'success',
										title: 'Success...',
										text: dataResult.message
									}).then(function() {
										// window.location = 'application.php';
										loadAmortizationTable(postApplicationNo,postBranchID,postProductCode);

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


		// confirm payment button
		$("#confirmPaymentForm").submit(function(e) {

			e.preventDefault();
	
			const form = document.getElementById("confirmPaymentForm");
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
	
						var data = $("#confirmPaymentForm").serialize();
						
	
							// Split the query string into an array of key-value pairs
							var keyValuePairs = data.split('&');
	
							// Create an empty object to store the key-value pairs
							var data = {};
	
							// Iterate through the key-value pairs and assign them to the object
							for (var i = 0; i < keyValuePairs.length; i++) {
								var pair = keyValuePairs[i].split('=');
								var key = decodeURIComponent(pair[0]);  // Decode the key (in case it contains special characters)
								var value = decodeURIComponent(pair[1]); // Decode the value
								data[key] = value;
							}
	
							// Now you have an object where each key is a variable name, and each value is the corresponding value
							var confirmRemarks = data.confirmRemarks;
							var confirmApplicationNo = data.confirmApplicationNo;
							var confirmBranchID = data.confirmBranchID;
							var confirmProductCode = data.confirmProductCode;
							var confirmInstallmentNo = data.confirmInstallmentNo;
							
						$.ajax({
							data: data,
							type: "post",
							url: "sql/application-sql-query.php",
							success: function(dataResult){
								var dataResult = JSON.parse(dataResult);
	
								if(dataResult.statusCode==0){
									
										$('#confirmPaymentModal').modal('hide');
	
										Swal.fire({
											icon: 'success',
											title: 'Success...',
											text: dataResult.message
										}).then(function() {
											// window.location = 'application.php';
											loadAmortizationTable(confirmApplicationNo,confirmBranchID,confirmProductCode);
	
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



	
});