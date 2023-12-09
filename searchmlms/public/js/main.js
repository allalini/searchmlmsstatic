const scrollup = document.getElementById("scroll-up");

if (scrollup) {
    // When the user scrolls down 20px from the top of the document, show the button
    window.addEventListener('scroll', () => {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            scrollup.style.opacity = 1;
            hideMessage();
        } else {
            scrollup.style.opacity = 0;
        }
    });
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function hideMessage(){
    // hide the session message if it is present.
    const message = document.getElementById("session-message");
    if (message){
        message.style.display = 'none';
    }
}