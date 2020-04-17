var textarea = document.getElementById("description")

// Event listener on the description textarea
textarea.addEventListener('input', valRegex)
function valRegex() {
    var text = textarea.value;
    if(/^[a-zA-Z0-9\w\s\S\\P].{0,65534}$/g.test(text) !== true){
        alert('input is invalid');
    }
}

