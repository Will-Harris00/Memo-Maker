var  timerId;
var  confirm_pass  =  document.getElementById('confirm_password');
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
    if (document.getElementById('password').value ===
        document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
    }
}