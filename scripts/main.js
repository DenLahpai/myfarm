//function to open menu
function openMenu () {
    $(".drop-menu").toggle(1000);
}

function openLoginForm () {
    $(".login-form").slideToggle(1000);
}


//function to login
function login() {
    var Mobile = $("#Mobile");
    var Password = document.getElementById("Password");
    var inputError = false;
    if (Mobile.val() == "") {
        Mobile.addClass('input-error');
        var inputError = true;
        var errorMsg = 'Please enter your phone number!';
        alert(errorMsg);
        $(".error").html(errorMsg);
    }
    // else if (Password.value )
}
