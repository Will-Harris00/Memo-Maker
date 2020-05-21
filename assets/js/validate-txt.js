var textarea = document.getElementById("description")

// Event listener on the description textarea
textarea.addEventListener('input', valRegex)

// Reset styling on click away blur
textarea.addEventListener('blur', function() {
    // Removes border shadow and resets outline
    textarea.style.outline = '';
    textarea.style.borderColor = '';
    textarea.style.boxShadow = '';
});

function valRegex() {
    var text = textarea.value;
    if (/^[a-zA-Z0-9\w\s\S\\P].{0,65534}$/g.test(text) !== true) {
        // textarea.setCustomValidity("Number, letters, symbols and punctuation only.");
        document.getElementById("submit_btn").disabled = true;
        textarea.style.outline = "none";
        textarea.style.borderColor = 'red';
        textarea.style.boxShadow = '0 0 10px red';
        // return false;
    } else {
        // textarea.setCustomValidity(""); // be sure to leave this empty!
        document.getElementById("submit_btn").disabled = false;
        textarea.style.outline = "none";
        textarea.style.borderColor = 'green';
        textarea.style.boxShadow = '0 0 10px green';
        /* To display custom validity message on description textarea
        you need to return boolean to form tag under the onsubmit. */
        // return true;
    }
    /* The above statement could be simplified to
    'document.getElementById("edit_task_btn").disabled
    = /^[a-zA-Z0-9\w\s\S\\P].{0,65534}$/g.test(text)
    !== true;' but for the purpose of readability
    I have chosen to show the full statement. */
}