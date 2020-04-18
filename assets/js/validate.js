var  timerId;
var inputs = document.signup_form;
var pass = inputs.password;
var confirm_pass = inputs.confirm_password;
var signup_btn = inputs.signup_btn;
console.log(confirm_pass);

// Event listener on the input box
confirm_pass.addEventListener('input', function() {
    // Debounces check method
    debounceFunction(check, 200)
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
        document.getElementById('confirm_password').style.borderColor = 'green';
        document.getElementById('confirm_password').style.boxShadow = '0 0 10px green';
        signup_btn.disabled = false;
    } else {
        signup_btn.disabled = true;
        document.getElementById('confirm_password').style.borderColor = 'red';
        document.getElementById('confirm_password').style.boxShadow = '0 0 10px red';
    }
}