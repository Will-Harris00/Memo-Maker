// Detects if 'save api key' button is clicked.

var myForm = document.API_key_input;
var myButton = myForm.btn1;


myButton.addEventListener("click", function(){
    document.write("You clicked the button!");
    console.log("Button clicked!")
});