//function to check 2 empty fields
function checkTwoFields (field1, field2, language) {
    var field1 = document.getElementById(field1);
    var field2 = document.getElementById(field2);

    if (field1.value == null || field1.value == 0 || field1.value == " ") {
        field1.style.background = 'red';
    }
    if (field2.value == null || field2.value == 0 || field2.value == " ") {
        field2.style.background = 'red';
    }

    if (field1.value == null || field1.value == 0 || field1.value == " " || field2.value == null || field2.value == 0 || field2.value == " " ) {
        switch (language) {
            case 'EN':
                var errorMessage = "Please fill out the empty field(s) in red!";
                break;
            case 'WP':
                var errorMessage = "Ahkyen hte madun da ai shara ni hpe naw sharai ya rit!";
            default:
        }
        document.getElementsByClassName('error')[0].innerHTML = errorMessage;
    }
    else {
        document.getElementById('buttonLogin').type = 'submit';
    }
}

//function to check and display error
function checkError() {
    var error = document.getElementsByClassName('error')[0];
    if (error.innerHTML !== null) {
        alert(error.innerHTML);
    }
}

//function to check if an input is a number
function checkNumber(string, language) {
    var string = document.getElementById(string);
    if (isNaN (string.value)) {
        if (language == 'EN') {
            var error = 'Only Numbers are allowed for Mobile field!';
        }
        else if (language == 'WP') {
            var error = 'Hti hkum sha bang ya rit!';
        }
        alert(error);
        string.style.background = 'red';
        return false;
    }
    else {
        string.style.background = 'white';
    }
}

//function to check if two password fields match
function checkPasswords (Password, repeatPassword, language) {
    var Password = document.getElementById(Password);
    var repeatPassword = document.getElementById(repeatPassword);

    if (Password.value != repeatPassword.value) {
        Password.style.background = 'red';
        repeatPassword.style.background = 'red';
        switch (language) {
            case 'EN':
                var error = 'Passwords do NOT match!';
                break;
            case 'WP':
                var error = 'Password ni nbung taw ai!'
                break;
            default:
        }
        alert(error);
    }
}

// function to search
function search (search) {
    alert('search');
}

//function to signup
function signup (language) {
    var signup = document.forms.signup;
    var First_name = signup.First_name;
    var Mobile = signup.Mobile;
    var Password = signup.Password;
    var repeatPassword = signup.repeatPassword;
    var DOB = signup.DOB;
    var Address = signup.Address;
    var Town = signup.Town;
    var State = signup.State;
    var Country = signup.Country;

    if (First_name.value == "" || First_name.value == null) {
        First_name.style.background = 'red';
        var error = true;
    }
    if (Mobile.value == "" || Mobile.value == null) {
        Mobile.style.background = 'red';
        var error = true;
    }
    if (isNaN (Mobile.value)) {
        Mobile.style.background = 'red';
        var error = true;
    }

    if (Password.value == "" || Password.value == null) {
        Password.style.background = 'red';
        var error = true;
    }
    if (Password.value != repeatPassword.value) {
        Password.style.background = 'red';
        repeatPassword.style.background = 'red';
        var error = true;
    }

    if (DOB.value == "" || DOB.value == null) {
        DOB.style.background = 'red';
        var error = true;
    }

    if (Address.value == "" || Address.value == null) {
        Address.style.background = 'red';
        var error = true;
    }
    if (Town.value == "" || Town.value == null) {
        Town.style.background = 'red';
        var error = true;
    }
    if (State.value == "" || State.value == null) {
        State.style.background = 'red';
        var error = true;
    }
    if (Country.value == "" || Country.value == null) {
        Country.style.background = 'red';
        var error = true;
    }
    if (error == true) {
        switch (language) {
            case 'EN':
                var errorMessage = "Please fill out or correct all field(s) in red!";
                break;
            case 'WP':
                var errorMessage = "Ahkyen hte madun da ai shara ni hpe naw sharai ya rit!";
                break;
            default:
        }
        alert(errorMessage);
    }
    else {
        document.getElementById('buttonSignup').type = 'submit';
    }
}
