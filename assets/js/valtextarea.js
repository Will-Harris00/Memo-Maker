var textarea = document.getElementById("description")

// Event listener on the description textarea
textarea.addEventListener('input', valRegex)
function valRegex() {
    alert(textarea.value)
    var errorMsg = "Please match the format requested.";
    var ta = this;
    alert(ta.value)
    var pattern = new RegExp('^' + $(ta).attr('pattern') + '$');
    // check each line of text
    $.each($(this).val().split("\n"), function () {
        // check if the line matches the pattern
        var hasError = !this.match(pattern);
        if (typeof ta.setCustomValidity === 'function') {
            ta.setCustomValidity(hasError ? errorMsg : '');
        } else {
            // Not supported by the browser, fallback to manual error display...
            $(ta).toggleClass('error', !!hasError);
            $(ta).toggleClass('ok', !hasError);
            if (hasError) {
                $(ta).attr('title', errorMsg);
            } else {
                $(ta).removeAttr('title');
            }
        }
    });
}

