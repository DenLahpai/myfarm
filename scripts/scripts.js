//function to check 2 empty fields
function checkTwoFields (field1, field2) {
    var field1 = document.getElementById(field1);
    var field2 = document.getElementById(field2);

    if (field1.value == null || field1.value == 0 || field1.value == " ") {
        field1.style.background = 'red';
    }
    if (field2.value == null || field2.value == 0 || field2.value == " ") {
        field2.style.background = 'red';
    }

    if (field1.value == null || field1.value == 0 || field1.value == " " || field2.value == null || field2.value == 0 || field2.value == " " ) {
        // document.getElementsByClassName('error')[0].innerHTML = "Please fill out the empty field(s) in red!";
        alert("Please fill out the empty field(s) in red!");
    }
    else {
        document.getElementById('buttonSubmit').type = 'submit';
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
function checkNumber(string) {
    var stringToCheck = document.getElementById(string);
    if (isNaN (stringToCheck.value)) {
        alert('Only Numbers are allowed for Mobile field!');
        stringToCheck.style.background = 'red';
        return false;
    }
}

//function to check if two password fields match
function checkPasswords (choosePassword, repeatPassword) {
    var choosePassword = document.getElementById(choosePassword);
    var repeatPassword = document.getElementById(repeatPassword);

    if (choosePassword.value != repeatPassword.value) {
        choosePassword.style.background = 'red';
        repeatPassword.style.background = 'red';
        alert('Passwords do NOT match!');
    }
}

// function to search
function search (search) {
    alert('search');
}

//function to signup
function signup () {
    var signup = document.forms.signup;
    var Name = signup.Name;
    var Mobile = signup.Mobile;
    var Password = signup.choosePassword;
    var repeatPassword = signup.repeatPassword;
    var DOB = signup.DOB;
    var Address = signup.Address;
    var Town = signup.Town;
    var State = signup.State;
    var Country = signup.Country;

    if (Name.value == "" || Name.value == null) {
        Name.style.background = 'red';
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
        alert("Please fill out or correct all field(s) in red!");
    }
    else {
        document.getElementById('buttonSignup').disabled = false;
    }
}
