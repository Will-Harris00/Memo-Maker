function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    document.preferences_form.apply_prefs_btn.disabled = true;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    document.preferences_form.apply_prefs_btn.disabled = false;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.key === 'ArrowDown') {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.key === 'ArrowUp') { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.key === 'Enter') {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt !== x[i] && elmnt !== inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

/*An array containing all the HTML colour names in the X11 colour scheme:*/
var colours = ['Antique White', 'Aqua', 'Aquamarine', 'Azure', 'Beige', 'Bisque', 'Black', 'Blanched Almond', 'Blue', 'Blue Violet', 'Brown', 'Burlywood', 'Cadet Blue', 'Chartreuse', 'Chocolate', 'Coral', 'Cornflower Blue', 'Cornsilk', 'Crimson', 'Cyan', 'Dark Blue', 'Dark Cyan', 'Dark Goldenrod', 'Dark Gray', 'Dark Green', 'Dark Khaki', 'Dark Magenta', 'Dark Olive Green', 'Dark Orange', 'Dark Orchid', 'Dark Red', 'Dark Salmon', 'Dark Sea Green', 'Dark Slate Blue', 'Dark Slate Gray', 'Dark Turquoise', 'Dark Violet', 'Deep Pink', 'Deep Sky Blue', 'Dim Gray', 'Dodger Blue', 'Firebrick', 'Floral White', 'Forest Green', 'Fuchsia', 'Gainsboro', 'Ghost White', 'Gold', 'Goldenrod', 'Gray', 'Web Gray', 'Green', 'Web Green', 'Green Yellow', 'Honeydew', 'Hot Pink', 'Indian Red', 'Indigo', 'Ivory', 'Khaki', 'Lavender', 'Lavender Blush', 'Lawn Green', 'Lemon Chiffon', 'Light Blue', 'Light Coral', 'Light Cyan', 'Light Goldenrod', 'Light Gray', 'Light Green', 'Light Pink', 'Light Salmon', 'Light Sea Green', 'Light Sky Blue', 'Light Slate Gray', 'Light Steel Blue', 'Light Yellow', 'Lime', 'Lime Green', 'Linen', 'Magenta', 'Maroon', 'Web Maroon', 'Medium Aquamarine', 'Medium Blue', 'Medium Orchid', 'Medium Purple', 'Medium Sea Green', 'Medium Slate Blue', 'Medium Spring Green', 'Medium Turquoise', 'Medium Violet Red', 'Midnight Blue', 'Mint Cream', 'Misty Rose', 'Moccasin', 'Navajo White', 'Navy Blue', 'Old Lace', 'Olive', 'Olive Drab', 'Orange', 'Orange Red', 'Orchid', 'Pale Goldenrod', 'Pale Green', 'Pale Turquoise', 'Pale Violet Red', 'Papaya Whip', 'Peach Puff', 'Peru', 'Pink', 'Plum', 'Powder Blue', 'Purple', 'Web Purple', 'Rebecca Purple', 'Red', 'Rosy Brown', 'Royal Blue', 'Saddle Brown', 'Salmon', 'Sandy Brown', 'Sea Green', 'Seashell', 'Sienna', 'Silver', 'Sky Blue', 'Slate Blue', 'Slate Gray', 'Snow', 'Spring Green', 'Steel Blue', 'Tan', 'Teal', 'Thistle', 'Tomato', 'Turquoise', 'Violet', 'Wheat', 'White', 'White Smoke', 'Yellow', 'Yellow Green'];

/*initiate the autocomplete function on the "bginput" element, and pass along the colours array as possible autocomplete values:*/
autocomplete(document.getElementById("bginput"), colours);

/*initiate the autocomplete function on the "fginput" element, and pass along the colours array as possible autocomplete values:*/
autocomplete(document.getElementById("fginput"), colours);