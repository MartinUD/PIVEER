// Assuming htmlStyle and bodyStyle are objects that contain CSS styles
var htmlStyle = document.documentElement.style;
var bodyStyle = document.body.style;

// Assuming you have a way to detect keyboard show/hide
window.addEventListener('keyboardWillShow', function () {
    htmlStyle.scrollSnapType = "none";
    bodyStyle.scrollSnapType = "none";
});

window.addEventListener('keyboardWillHide', function () {
    htmlStyle.scrollSnapType = "y mandatory";
    bodyStyle.scrollSnapType = "y mandatory";
});
