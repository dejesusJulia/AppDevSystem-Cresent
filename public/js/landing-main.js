//Get the button
const backToTopButton = document.getElementById("back-to-top-btn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
scrollFunction();
};

function scrollFunction() {
if (
	document.body.scrollTop > 300 ||
	document.documentElement.scrollTop > 300
) {
	backToTopButton.style.display = "block";
} else {
	backToTopButton.style.display = "none";
}
}
// When the user clicks on the button, scroll to the top of the document
backToTopButton.addEventListener("click", backToTop);

function backToTop() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}