//function to open a modal
function openModal (open) {
    var itemToOpen = document.getElementById(open);
    itemToOpen.style.display = 'block';
}

//function to close modal
function closeModal (close) {
    var itemToClose = document.getElementById(close);
    itemToClose.style.display = 'none';
}

//fucntion to close modals
function closeModals () {
    closeModal ('menu');
    closeModal ('loginForm');
    closeModal ('aboutUs');
}

//function to open menu
function openMenu () {
    openModal ('menu');
}


window.addEventListener('click', outsideClick);

//function to close the modal if a blank space is pressed
function outsideClick(e) {
    var menu = document.getElementById('menu');
    if (e.target == menu) {
        menu.style.display = 'none';
    }
}
