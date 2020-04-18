var textarea = document.getElementById("description")

// Event listener on the description textarea
textarea.addEventListener('input', valRegex)

function valRegex() {
    var text = textarea.value;
    if (/^[a-zA-Z0-9\w\s\S\\P].{0,65534}$/g.test(text) !== true) {
        // textarea.setCustomValidity("Number, letters, symbols and punctuation only.");
        document.getElementById("edit_task_btn").disabled = true;
        // return false;
    } else {
        // textarea.setCustomValidity(""); // be sure to leave this empty!
        document.getElementById("edit_task_btn").disabled = false;
        /* To display custom validity message on description textarea
        you need to return boolean to form tag under the onsubmit. */
        // return true;
    }
    /* The above statement could be simplified to
    'document.getElementById("edit_task_btn").disabled
    = /^[a-zA-Z0-9\w\s\S\\P].{0,65534}$/g.test(text)
    !== true;' but for the purpose of clarity
    I have chosen to show the full statement. */
}

