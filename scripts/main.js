function chooseLanguage (){
    var lang = $("#lang").val();
    window.location.href = lang;
}

function displayLoginForm () {
    $(".login-form").slideToggle(1000);
}
