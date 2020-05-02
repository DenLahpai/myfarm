function chooseLanguage (){
    var language = $("#language").val();
    window.location.href = '../' + language;
}

function displayLoginForm () {
    $(".login-form").slideToggle(1000);
}
