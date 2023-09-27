document.addEventListener('DOMContentLoaded', function() {
    // JavaScript code for the contact page content goes here
    // For example, you can add event listeners, modify elements, etc.
    // loading page 
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
    
    // Use JavaScript to detect when the table data has finished loading
    window.addEventListener('load', function () {
        // Hide the SweetAlert modal when the data is loaded
        Swal.close();
    });


});