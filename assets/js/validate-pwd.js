var  timerId;
var inputs = document.signup_form;
var pass = inputs.password;
var confirm_pass = inputs.confirm_password;
var signup_btn = inputs.signup_btn;
console.log(confirm_pass);

// Event listener on the input box
confirm_pass.addEventListener('input', function() {
    // Debounce check method
    debounceFunction(check, 200)
});

// Reset styling on click away blur
confirm_pass.addEventListener('blur', function() {
    // Removes border shadow and resets outline
    confirm_pass.style.outline = '';
    confirm_pass.style.borderColor = '';
    confirm_pass.style.boxShadow = '';
});

// Debounce function: Input as function which needs to be debounced and delay is the debounced time in milliseconds
function debounceFunction(func, delay) {
    // Cancels the setTimeout method execution
    clearTimeout(timerId);
    // Executes the func after delay time.
    timerId  =  setTimeout(func, delay)
}

function check() {
    if (pass.value === confirm_pass.value) {
        confirm_pass.style.outline = "none";
        confirm_pass.style.borderColor = 'green';
        confirm_pass.style.boxShadow = '0 0 10px green';
        signup_btn.disabled = false;
    } else {
        signup_btn.disabled = true;
        confirm_pass.style.outline = "none";
        confirm_pass.style.borderColor = 'red';
        confirm_pass.style.boxShadow = '0 0 10px red';
    }
}
