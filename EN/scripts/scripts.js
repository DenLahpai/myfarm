//function to open menu
function openMenu () {
    $(".drop-menu").slideToggle(1000);
}

//function to open login-form
function openLoginForm () {
    $(".login-form").slideToggle(1000);
}

//function to login
function login() {
    var Mobile = $("#Mobile");
    var Password = $("#Password");
    var inputError = false;
    var errorMsg = "";
    Mobile.removeClass('input-error');
    Password.removeClass('input-error');

    if (Mobile.val() == "") {
        Mobile.addClass('input-error');
        var inputError = true;
        var errorMsg = 'Please enter your phone number! ';
        $(".error").html(errorMsg);
    }

    if (Password.val() == "") {
        Password.addClass('input-error');
        var inputError = true;
        if (errorMsg) {
            errorMsg += "Please enter your password!";
        }
        else {
            var errorMsg = "Please enter your password!";
        }
        $(".error").html(errorMsg);
    }

    if (inputError == false) {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: $("#login-form").serialize(),
            success: function(data) {
                var response = data;
                if (response == 1) {
                    var errorMsg = "";
                    window.location.href = 'home.html';
                }
                else {
                    var errorMsg = "Wrong Phone Number or Password!";
                    $(".error").html(errorMsg);
                }
            }
        });
    }
}

// function to check session
function checkSession (){
    $.ajax({
        url: "../check_session.php",
        method: "POST",
        success: function(data) {
            if (data == 0) {
                // alert("Session Expired!");
                window.location.href="EN";
            }
            else {
                var UsersName = data;
                var logout =  "<h4 onclick=\"logout();\">Logout</h4>";
                $("#UsersName").val(UsersName);
                $(".nav-right").html(logout);
            }
        }
    });
}

//function to logout
function logout () {
    window.location.href="logout.php";
}
