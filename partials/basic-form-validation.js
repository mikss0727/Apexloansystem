//   form validation 
function ValidationFeedback(form) {
    const inputFields = form.querySelectorAll('.form-control');
    const validFeedbackList = form.querySelectorAll('.valid-feedback');
    const invalidFeedbackList = form.querySelectorAll('.invalid-feedback');

    let allFieldsValid = true;

    inputFields.forEach((inputField, index) => {
       
        if (inputField.validity.valid) {
            validFeedbackList[index].style.display = 'block';
            invalidFeedbackList[index].style.display = 'none';
        } else {
            validFeedbackList[index].style.display = 'none';
            invalidFeedbackList[index].style.display = 'block';
            allFieldsValid = false;
        }
    
    });
    return allFieldsValid;
}

// reload change in Select option 
function reloadSelectUi(){
	// Trigger the 'change' event to update the Select2 UI
	$('.js-example-basic-single').trigger('change');
}

// Accept number only 
function validateDecimalInput(input) {
    input.value = input.value.replace(/\D/g, '');
}

// Accept number only with 1 decimal
function validateWithDecimalInput(input) {
    input.value = input.value.replace(/[^0-9.]/g, '');

    // Remove extra decimal points
    input.value = input.value.replace(/(\..*)\./g, '$1');
}

// Accept number only with length of 11 for contact number
function validateContactNo(input) {
    input.value = input.value.replace(/\D/g, '');

    const maxLength = 11;
  
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);

        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Only 11 numbers required!'
          })
    }
}

function resetForm(myForm) {
    const form_id = myForm.id;

    $("#".form_id).trigger("reset");
    document.getElementById(form_id).reset();
    reloadSelectUi();

    const inputFields = myForm.querySelectorAll('.form-control');
    const validFeedbackList = myForm.querySelectorAll('.valid-feedback');
    const invalidFeedbackList = myForm.querySelectorAll('.invalid-feedback');

    inputFields.forEach((inputField, index) => {
            validFeedbackList[index].style.display = 'none';
            invalidFeedbackList[index].style.display = 'none';
    });
}
