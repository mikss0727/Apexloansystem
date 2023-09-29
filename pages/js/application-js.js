
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
		url: 'sql/application-sql.php',
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
						url: "sql/application-sql.php",
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
                        url: "sql/application-sql.php",
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
					url: "sql/application-sql.php",
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
	
});