document.getElementById('html').style = htmlStyle
document.getElementById('body').style = bodyStyle

window.addEventListener('keyboardWillShow', function () {
    htmlStyle.scrollSnapType = "none";
    bodyStyle.scrollSnapType = "none";
});

window.addEventListener('keyboardWillHide', function () {
    htmlStyle.scrollSnapType = "y mandatory";
    bodyStyle.scrollSnapType = "y mandatory";
});