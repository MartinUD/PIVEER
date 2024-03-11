// Get references to the <html> and <body> elements' styles
var htmlStyle = document.documentElement.style;
var bodyStyle = document.body.style;

// Function to disable scroll snap
function disableScrollSnap() {
    htmlStyle.scrollSnapType = "none";
    bodyStyle.scrollSnapType = "none";
}

// Function to enable scroll snap
function enableScrollSnap() {
    htmlStyle.scrollSnapType = "y mandatory";
    bodyStyle.scrollSnapType = "y mandatory";
}

// Attach focus event listeners to all input elements
document.querySelectorAll('input').forEach(function(input) {
    input.addEventListener('focus', disableScrollSnap);
});

// Attach blur event listeners to all input elements
document.querySelectorAll('input').forEach(function(input) {
    input.addEventListener('blur', enableScrollSnap);
});