var textarea = document.getElementById("description")

// Event listener on the description textarea
textarea.addEventListener('input', valRegex)
function valRegex() {
    var text = textarea.value;
    alert(text);
    if(/^[a-zA-Z0-9\w\s\S\\P].{0,6}$/g.test(text) !== true){
        textarea.setCustomValidity("Number, letters, symbols and punctuation only.");
        document.getElementById("edit_btn").disabled = true;
        return false;
    } else {
        textarea.setCustomValidity(""); // be sure to leave this empty!
        document.getElementById("edit_btn").disabled = false;
        alert("wrong");
        editRow();
        return true;
    }
}

