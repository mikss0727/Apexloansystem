// logout
$(document).on('click','#logout_btn',function(e) {

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Log Out!'
	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'GET',
				url: 'logout/logout_script.php',
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);

					if(dataResult.statusCode==0){
						
						Swal.fire({
							icon: 'success',
							title: 'Success...',
							text: dataResult.message
						}).then(function() {
							window.location.href = "../index.php";
						});
					}
					
				}
			});
		}
	})
});


// show hide div
$(document).on('click','#addPosition',function(e) {
	
	$('#tbl_postition').hide();
	$('#add_postition').show();

	
});

// edit user
$(document).on('click','#editPosition',function(e) {

	$('#tbl_postition').hide();
	$('#edit_postition').show();

	var edit_postitionID=$(this).attr("data-pos_id");
	var edit_postitionName=$(this).attr("data-pos_name");
	var edit_isActive=$(this).attr("data-isactive");
	var pk_id=$(this).attr("data-pk_id");



	$('#edit_postitionID').val(edit_postitionID);
	$('#edit_postitionName').val(edit_postitionName);
	$('#edit_isActive').val(edit_isActive);
	$('#pk_id').val(pk_id);
});

// show hide div
$(document).on('click','#cancel_add',function(e) {
	// get data in form
    $('#tbl_postition').show();
	$('#add_postition').hide();
	
});

// show hide div
$(document).on('click','#cancel_edit',function(e) {
	// get data in form
	$('#tbl_postition').show();
	$('#edit_postition').hide();
	
});

// add user submit
$("#addPosition_form").submit(function(e) {

    
	var add_postitionID = document.getElementById("add_postitionID").value;
	var add_postitionName = document.getElementById("add_postitionName").value;
	var add_isActive = document.getElementById("add_isActive").value;

	if (add_postitionID =='' || add_postitionName =='' || add_isActive =='')
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

                var data = $("#addPosition_form").serialize();
                $.ajax({
                    data: data,
                    type: "post",
                    url: "position/position_query.php",
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);

                        if(dataResult.statusCode==0){
                            
                            $('#add_postition').hide();
                            $('#tbl_postition').show();

                                // alert('Data added successfully !'); 
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    text: dataResult.message
                                }).then(function() {
                                    window.location = 'position.php';
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
$("#positionEdit_form").submit(function(e) {


	var edit_postitionID = document.getElementById("edit_postitionID").value;
	var edit_postitionName = document.getElementById("edit_postitionName").value;
	var edit_isActive = document.getElementById("edit_isActive").value;

	if (edit_postitionName == '' || edit_isActive == '')
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
                
                var data = $("#positionEdit_form").serialize();
                console.log(data);
                $.ajax({
                    data: data,
                    type: "post",
                    url: "position/position_query.php",
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);

                        if(dataResult.statusCode==0){
                            
                                // alert('Data added successfully !'); 
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success...',
                                    text: dataResult.message
                                }).then(function() {
                                    window.location = 'position.php';
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
$(document).on('click','#deletePosition',function(e) {
	var pk_id=$(this).attr("data-pk_id");
	var pos_id=$(this).attr("data-pos_id");

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
					process:'deletePosition',
					pk_id: pk_id,
					pos_id: pos_id
				},
				type: "post",
				url: "position/position_query.php",
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);

					if(dataResult.statusCode==0){


						// alert('Data added successfully !'); 
						Swal.fire({
							icon: 'success',
							title: 'Success...',
							text: dataResult.message
						}).then(function() {
							window.location = 'position.php';
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



















