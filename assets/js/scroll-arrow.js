/*Scroll to top when arrow up clicked*/

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 125 || document.documentElement.scrollTop > 125) {
        document.getElementById('back2Top').style.display = "block";
    } else {
        document.getElementById('back2Top').style.display = "none";
    }
}

/* Smooth scrolling animation redundant as already defined in CSS
/*
function animateScroll() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function scrollDelay(ms) {
    return new Promise(res => setTimeout(res, ms));
}

document.getElementById("back2Top").onclick = async function() {
    for (var y = 0; y <= 4200; y += 100) {
        window.scrollTo({top: y, behavior: 'smooth'})
        await scrollDelay(100)
    }
}
*/
