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
    var Username = $("#Username");
    var Password = $("#Password");
    var inputError = false;
    var errorMsg = "";
    Username.removeClass('input-error');
    Password.removeClass('input-error');

    if (Username.val() == "") {
        Username.addClass('input-error');
        var inputError = true;
        var errorMsg = 'Please enter your username! ';
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
                window.location.href="index.html";
            }
            else {
                // var UsersName = data;                
                // $("#UsersName").html(UsersName);
                $(".nav-right").load('includes/nav-right.php');
            }
        }
    });
}

//function to logout
function logout () {
    window.location.href="logout.php";
}

//function to send contact page data
function sendContactPageData() {

    var Name = $("#Name");
    var Email = $("#Email");
    var Message = $("#Message");
    var inputError = false;
    var errorMsg = "";
    Name.removeClass('input-error');
    Email.removeClass('input-error');
    Message.removeClass('input-error');

    if (Name.val() == "" || Name.val() == null) {
        Name.addClass('input-error');
        var inputError = true;
        var errorMsg = "Please enter your name! ";
    }
    if (Email.val() == "" || Email.val() == null) {
        Email.addClass('input-error');
        var inputError = true;

        if (errorMsg) {
            errorMsg += "Please enter your email! ";
        }
        else {
            errorMsg = "Please enter your email! ";
        }
    }
    if (Message.val() == "" || Message.val() == null) {
        Message.addClass('input-error');
        var inputError = true;

        if (errorMsg) {
            errorMsg += "Your message cannot be blank!";
        }
        else {
            errorMsg = "Your message cannot be blank!";
        }
    }

    if (inputError == false) {
        $.ajax({
            type: "POST",
            url: "contactus.php",
            data: $("#contact-form").serialize(),
            success: function(data) {
                alert(data);
            }
        });
    }
    $(".error").html(errorMsg);
}

//function to validate email 
// Note function copied from Stackoverflow.com
function validateEmail(sEmail) {
  var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!sEmail.match(reEmail)) {
    alert("Invalid email address!");
    return false;
  }
  return true;
}



//                                          ********************** Functions for registrations ***************************

//function to check for username duplication
function checkUsername () {
    var Username = $("#Username1");
    var l = Username.val().trim().length;
    
    if (l > 12) {
        //if username is longer than 12 characters
        $("#usernameError").addClass('error');
        $("#usernameError").html('Username must not be longer than 12 letters!');
        $("#btn-submit").attr("disabled", "disabled");
    }
    else if (l < 4) {
        $("#usernameError").addClass('error');
        $("#usernameError").html('Username must be at least 4 letters!');
        $("#btn-submit").attr("disabled", "disabled");
    }
    else {
        $.post("../check_username.php", {
            Username: Username.val().trim()
        } , function (data) {
            if (data == 0) {
                //No duplicate entry
                $("#usernameError").removeClass('error');
                $("#usernameError").addClass('green');
                var msg = "Username <span style='font-style: italic'>" + Username.val().trim() + "</span> is available!";
                $("#usernameError").html(msg);
                $("#btn-submit").removeAttr("disabled");            
            }
            else {
                //Duplicate entry
                $("#usernameError").addClass('error');
                $("#usernameError").html("Username already exists! Please choose another one!");
                $("#btn-submit").attr("disabled", "disabled");
            }
        });
    }
}

//function to check passwords
function checkPasswords () {
    var Password1 = $('#Password1');
    var Password2 = $('#Password2');
    var l = Password1.val().trim().length;
    if (l < 6) {
        $("#passwordStatus").addClass('error');
        $("#passwordStatus").html('Password must be at least 6 letters!');
        $('#btn-submit').attr("disabled", "disabled");
    }
    else {
        if (Password1.val().trim() != Password2.val().trim()) {
            $('#passwordStatus').addClass('error');
            $('#passwordStatus').html('Passwords do not match!');
            $('#btn-submit').attr("disabled", "disabled");
        }
        else {
            $('#passwordStatus').removeClass('error');
            $('#passwordStatus').addClass('green');
            $('#passwordStatus').html('Passwords match!');
            $("#btn-submit").removeAttr("disabled");
        }
    }
}



//function to register
function register() {
    var Username = $('#Username1');
    var Title = $('#Title');
    var Name = $('#Name');
    var Mobile = $('#Mobile');
    var Password1 = $('#Password1');
    var Password2 = $('#Password2');
    var DOB = $('#DOB');
    var Address = $('#Address');
    var Town = $('#Town');
    var State = $('#State');
    var CountryCode = $('#CountryCode');

    Username.removeClass('input-error');
    Title.removeClass('input-error');
    Name.removeClass('input-error');
    Mobile.removeClass('input-error');
    Password1.removeClass('input-error');
    Password2.removeClass('input-error');
    DOB.removeClass('input-error');
    Town.removeClass('input-error');
    State.removeClass('input-error');
    response = $("#response1");

    var inputError = false;
    var errorMsg = "";
    response.removeClass('error');


    if (Username.val().trim() == "") {
        var inputError = true;
        Username.addClass('input-error');
        errorMsg += 'Please choose a username! ';
        response.addClass('error');
        response.html(errorMsg);       
    }
    
    if (Title.val() == "") {
        var inputError = true;
        Title.addClass('input-error');
        errorMsg += 'Please choose a title! ';
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Name.val().trim() == "") {
        var inputError = true;
        Name.addClass('input-error');
        errorMsg += " Please enter your name! "; 
        response.addClass('error');
        response.html(errorMsg);            
    }

    if (Mobile.val().trim() == "") {
        var inputError = true;
        Mobile.addClass('input-error');
        errorMsg += " Please enter your phone number! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Password1.val().trim() == "") {
        var inputError = true;
        Password1.addClass('input-error');
        Password2.addClass('input-error');
        errorMsg += " Please set up a password! ";   
        response.addClass('error');
        response.html(errorMsg);      
    }

    if (DOB.val() == "") {
        var inputError = true;
        DOB.addClass('input-error');
        errorMsg += " Please enter your date of birth! ";  
        response.addClass('error');
        response.html(errorMsg);        
    }

    if (Town.val().trim() == "") {
        var inputError = true;
        Town.addClass('input-error');
        errorMsg += " Please enter your town! ";
        response.addClass('error');
        response.html(errorMsg); 
    }

    if (State.val().trim() == "") {
        var inputError = true;
        State.addClass('input-error');
        errorMsg += " Please enter your state/province! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (CountryCode.val() == "") {
        var inputError = true;
        CountryCode.addClass('input-error');
        errorMsg += " Please choose your country! ";
        response.addClass('error');
        response.html(errorMsg);  
    }    
    
    if (inputError == false) {
        $.ajax({
            method: 'POST', 
            url: "register.php", 
            data: $("#registration-form").serialize(), 
            success: function(data){
                if (data == 0) {
                    //if no error OK is returned
                    alert('Account created successfully! Please login to start using our platform.');
                    window.location.href = 'index.html';
                } 
                if (data == 1) {
                    //1 is returned as connection error!
                    var error = "<span class='error'>There was a connection error! Please try again!</span>";
                    response.html(error);
                }
            }
        });        
    }   
}

//                      ********************* End of functions for resgistration *********************

//                      ********************* Funciton to Update Users Data ************************

//function to update user data
function updateUserData() {
    var Title = $('#Title');
    var Name = $('#Name');
    var Mobile = $('#Mobile');
    var DOB = $('#DOB');
    var Address = $('#Address');
    var Town = $('#Town');
    var State = $('#State');
    var CountryCode = $('#CountryCode');

    Title.removeClass('input-error');
    Name.removeClass('input-error');
    Mobile.removeClass('input-error');
    DOB.removeClass('input-error');
    Town.removeClass('input-error');
    State.removeClass('input-error');
    response = $("#response");

    var inputError = false;
    var errorMsg = "";
    response.removeClass('error');
   
    if (Title.val() == "") {
        var inputError = true;
        Title.addClass('input-error');
        errorMsg += 'Please choose a title! ';
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Name.val().trim() == "") {
        var inputError = true;
        Name.addClass('input-error');
        errorMsg += " Please enter your name! "; 
        response.addClass('error');
        response.html(errorMsg);            
    }

    if (Mobile.val().trim() == "") {
        var inputError = true;
        Mobile.addClass('input-error');
        errorMsg += " Please enter your phone number! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (DOB.val() == "") {
        var inputError = true;
        DOB.addClass('input-error');
        errorMsg += " Please enter your date of birth! ";  
        response.addClass('error');
        response.html(errorMsg);        
    }

    if (Town.val().trim() == "") {
        var inputError = true;
        Town.addClass('input-error');
        errorMsg += " Please enter your town! ";
        response.addClass('error');
        response.html(errorMsg); 
    }

    if (State.val().trim() == "") {
        var inputError = true;
        State.addClass('input-error');
        errorMsg += " Please enter your state/province! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (CountryCode.val() == "") {
        var inputError = true;
        CountryCode.addClass('input-error');
        errorMsg += " Please choose your country! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (inputError == false) {
        $.ajax({
            url: 'includes/update_user.php',
            type: 'POST',
            data: $("#update-user-form").serialize(),
            success: function(data) {
                if (data == 0) {
                    // zero is returned if there is no errror!
                    var msg = "<span class='green'>Your details have been updated successfully!</span>";
                    response.html(msg);
                }
                if (data == 1) {
                    // 1 is returned if there is a connection error!
                    var errorMsg = "<span class='error'>There was a connection error! Please try again!</span>";
                    response.html(errorMsg);
                }
            },
        });
    }   
}


//                      ********************* Functions for new Post *********************

//function to dispaly preview of an image to be uploaded
function imagePreview(input) {
    if (input.files && input.files[0]) {
        var img = document.getElementById('Image').files[0];
        var imageName = img.name;
        var imageExtension = imageName.split('.').pop().toLowerCase();
        if(jQuery.inArray(imageExtension, ['png', 'jpg', 'jpeg']) == -1) {
            alert("Invalid Image Type");
            $("#btn-submit").attr('disabled', 'disabled');
        }
        var imageSize = img.size;
        if (imageSize > 12000000) {
            alert("Image is too large!");
            $("#btn-submit").attr('disabled', 'disabled');      
        }
        else {
            $("#btn-submit").removeAttr('disabled');
            var imagePv = new FileReader();
            imagePv.onload = function (e) {
                $("#image_preview").attr('src', e.target.result);
            };
            imagePv.readAsDataURL(input.files[0]);    
        }
  
    }

}

function preview() {
    $("#images").on('change', function(e) {
        var files = e.target.files;

        $.each(files, function(i, file){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                var template = '<img scr="'+e.target.result+'">';
                $(".image_preview").append(template);
            };
        }); 
    });

}

//function to get tags 
function getTags (selectedId) {
    $.post("includes/select_tags.php", {
        selectedId: selectedId
        }, function(data) {
            $("#TagsId").append(data);
    });
}

//function to insert new post
function insertNewPost() {
    var fdata = new FormData();
    var files = $("#Image")[0].files[0];
    fdata.append('Image', files);

    var Title = $("#Title");
    var Description = $("#Description");
    var TagsId = $("#TagsId");

    if (Title.val() == "") {
        $("#btn-submit").attr('disabled', 'disabled');
        Title.addClass("input-error");
        alert('Please put a title!');
    }

    else {
        Title.removeClass("input-error");
        var url = "includes/insert_post.php?Title=" + Title.val().trim() + "&Description=" + Description.val().trim() + "&TagsId=" + TagsId.val();
        
        $.ajax({
            url: url,
            type: 'post',
            data: fdata,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data === 0) {
                    // zero is returned if there is no error!
                    Toggle('new-post');
                    reloadPosts('select_posts.php');
                    alert('Your post has been uploaded successfully!');
                }
                else {
                    // 1 us retured if there is an error!
                    alert ("There was a connection error! Please try again!");
                    reloadPosts('select_posts.php');
                }
            }
        });
    }
}

function reloadPosts (source) {
    var sorting = $("#sorting").val();
    var search = $("#search").val().trim();
    var limit = $("#limit").val();
    
    checkForRemainingData ();

    $.post ('includes/' + source, {
        sorting: sorting,
        search: search,
        limit: limit
        }, function(data) {
            $("#posts-data").html(data);
        }
    );
}

function deletePost(id) {
    var r = confirm("Are you sure to delete this post! Once deleted it cannot be recovered!");
    if (r == true) {
        $.post ('includes/delete_post.php', {
            Id: id
            }, function (data){
                if (data == 0) {
                    reloadPosts('my_posts.php');
                }
                else {
                    alert('There was a connection error! Please try again!');
                }                
            }
        );
    }
}

function checkForRemainingData () {
    var i = $("#remaining-data").html();
    if (i <= 0) {
        $("#btn-load-more").attr('disabled', 'disabled');
        $("#btn-load-more").html('No More Posts!');
    }
    else {
        $("#btn-load-more").removeAttr('disabled', 'disabled');
        $("#btn-load-more").html('Load More');
    }
}

//function to bookmark a post
function bookmarkPost (PostsLink) {
	
	$.post("includes/bookmark_post.php", {
		PostsLink: PostsLink
		}, function (data) {
			
			if (data == 0) {
				// Zero is returned if there is no error!
				var msg = "This post has been added to your favorite list!";
				alert(msg);
			}
	
			if (data == 1) {
				// One is returned for connection error!
				var errorMsg = "There was a connection problem!";
				alert(errorMsg);
			}
		}
	);
}

// function to remove bookmark
function removeBookmark (BookmarksId) {
    $.post('includes/remove_bookmark.php', {
        BookmarksId: BookmarksId
    }, function(data){
        
        if (data == 0) {
            var msg = 'This post has been removed from your bookmarks!';
            alert(msg);
        }

        if (data == 1) {
            var errorMsg = 'There was a connection problem! Please try again!';
            alert(errorMsg);
        }
        reloadPosts('my_bookmarks.php');
    });
}


//                      ********************* End of functions for new Post *********************




