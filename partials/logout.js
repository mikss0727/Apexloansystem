document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.

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
                    url: 'sql/logout-sql-query.php',
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


});